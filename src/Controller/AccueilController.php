<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

class AccueilController extends AbstractController
{


    /** 
    *@var Environment
    */
private $twig;

public function __construct(Environment $twig){
    $this ->twig = $twig;
}



    public function index(): Response
    {

        return $this->render('accueil/index.html.twig', [
            'controller_name' => 'AccueilController',
        ]);
    }
}

?>
