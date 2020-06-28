<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;


class AccueilController extends AbstractController
{


    /** 
    *@var Environment
    */
private $twig;

public function __construct(Environment $twig){
    $this ->twig = $twig;
}



    public function index(PaginatorInterface $paginator, Request $request): Response
    {
        $articleRepository = $this->getDoctrine()->getRepository('App\Entity\Article');

        // $GetAllArticle= $articleRepository->findAllArticle();


        $GetAllArticle= $paginator->paginate($articleRepository->findAllArticle(),
        $request -> query -> getInt('page', 1), 
            4
        );


        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
            'getAllArticle' => $GetAllArticle,
        ]);
    }
}




?>
