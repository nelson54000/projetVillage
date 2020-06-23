<?php

namespace App\Repository;

use App\Entity\Property;
use App\Entity\PropertySearch;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Migrations\Query\Query;
use Doctrine\ORM\QueryBuilder;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Property|null find($id, $lockMode = null, $lockVersion = null)
 * @method Property|null findOneBy(array $criteria, array $orderBy = null)
 * @method Property[]    findAll()
 * @method Property[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PropertyRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Property::class);
    }


    /**
     * 
     * @return Property[]
     */
    public function findAllVisible()
    {
        return $this->findVisibleQuery()
            // return $this-> createQueryBuilder('p')
            // ->where('p.sold = 0')
            ->getQuery()
            ->getResult();
    }



    /**
     *
     * @return Query
     */
    public function findAllVisibleQuery(PropertySearch $search)
    {
        $query = $this->findVisibleQuery();
        if ($search->getMaxPrice()) {
            $query = $query->andWhere('p.price <= :maxprice');
            $query->setParameter('maxprice', $search->getMaxPrice());
        }

        if ($search->getMinSurface()) {
            $query = $query->andWhere('p.surface >= :minsurface');
            $query->setParameter('minsurface', $search->getMinSurface());
        }

        return $query->getQuery();
    }


    /**
     * 
     * @return Property[]
     */
    public function findLatestRealEstate(): array
    {
        return $this->findVisibleQuery()
            // return $this-> createQueryBuilder('p')
            // ->where('p.sold = 0')
            ->setMaxResults(20)
            ->getQuery()
            ->getResult();
    }

    private function findVisibleQuery(): QueryBuilder
    {
        return $this->createQueryBuilder('p')
            ->where('p.sold = 0');
    }

    // public function findAllVisible()
    // {

    //     $qb = $this->createQueryBuilder('p')
    //         ->where('p.floor = 4');

    //     $query = $qb->getQuery();
    //     return $query->execute();
    // }


    // ******************* Attention*Code fournie par symfony:************************************

    // /**
    //  * @return Property[] Returns an array of Property objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Property
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
