<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class NewsDuVillageController extends AbstractController
{
    /**
     * @Route("/accueil/newsDuVillage", name="newsDuVillage")
     */
    public function index()
    {
        return $this->render('/accueil/newsDuVillage.html.twig', [
            'controller_name' => 'NewsDuVillageController',
        ]);
    }

} 