<?php

namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use APP\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Persistence\ObjetManager;
use Knp\Component\Pager\Paginator;
use Knp\Component\Pager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use App\Form\PropertySearchType;
// use Doctrine\ORM\Query;
use Doctrine\Migrations\Query\Query;

class PropertyController extends AbstractController
{

    /** 
     *@var Environment
     */
    private $twig;


    /**
     *@var PropertyRepository
     */
    private $repository;


    /**
     *@var ObjetManager
     */
    private $em;



    //     public function __construct(Environment $twig, PropertyRepository $repository, ObjetManager $em ){
    //         $this ->twig = $twig;
    //  $this->repository = $repository;
    //   $this->em = $em;

    //     }


    // ***************************récupérer les données méthode2:

    // public function _construct(PropertyRepository  $repository){

    // $this->repository = $repository;
    // }
    //************************************************************** */


    /**
     * @param PropertyRepository $repository
     * @return Response
     * 
     * 
     */
    //PropertyRepository $repository
    public function index(PaginatorInterface $paginator, Request $request): Response
    {



        // $property = new Property();
        // $property ->setTitle('Mon 1er bien')
        // ->setPrice(200000)
        // ->setRooms(4)
        // ->setBedrooms(3)
        // ->setDescription('Une petite description')
        // ->setSurface(60)
        // ->setFloor(4)
        // ->setHeat(1)
        // ->setCity('Montpellier')
        // ->setAdress('18 rue Gambetta')
        // ->setPostalCode('56 000');
        // $em = $this->getDoctrine()->getManager();

        // $em->persist($property);
        // $em->flush();


        // *****récup du repository:
        $repository = $this->getDoctrine()->getRepository('App\Entity\Property');


        // ***************************récupérer les données méthode1:
        // $repository = $this->getDoctrine()->getRepository(Property::class);

        // dump($repository);
        // $reponse = $repository -> find(1);
        // $reponse = $repository -> findAll();
        $reponse = $repository->findOneBy(['floor' => 4]);
        dump($reponse);
        //************************************************************** */


        // ***************************récupérer les données méthode2:
        // $property = $this -> repository->find(1);
        // dump($property);
        //************************************************************** */


        // $property = $this->getDoctrine()->getRepository(Property::class);
        // $reponseProperty =  $property-> findAllVisible();
        $reponseProperty = $repository->findAllVisible();
        dump($reponseProperty);
        // ce code fonctionne

        //mettre à jour la bdd:
        // $hello=$reponseProperty[0]->setSold(1);
        // $em = $this->getDoctrine()->getManager();
        // $em->persist($hello);
        // $em->flush();

        $properties = $repository->findLatestRealEstate();

    
// *************************Formulaire Prix, Surface

       $search = new PropertySearch();

       $form = $this->createForm(PropertySearchType::class, $search);

       $form->handleRequest($request);


// *************************

        $properties2 = $paginator->paginate(
            $repository -> findAllVisibleQuery($search),
            $request -> query -> getInt('page', 1), 
            12
        );


        return $this->render('RealEstate/PropertyIndex.html.twig', [
            'controller_name' => 'PropertyController',
            'current_menu' => 'propertiesMenu',
            'properties' => $properties2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * 
     * 
     * 
     * 
     */
    public function propertyAtShow($id): Response
    {

        // *****récup du repository:
        $repository = $this->getDoctrine()->getRepository('App\Entity\Property');

        $propertyAtShow = $repository->find($id);
        return $this->render('RealEstate/propertyShow.html.twig', [
            'propertyAtShow' => $propertyAtShow,
            'controller_name' => 'PropertyController',
            'current_menu' => 'propertiesMenu',
        ]);
    }
}
