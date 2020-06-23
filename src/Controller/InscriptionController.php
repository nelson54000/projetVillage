<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;
use App\Form\UserType;


class InscriptionController extends AbstractController
{
    /**
     * @Route("/Inscription/Inscription", name="Inscription")
     */
    public function createNewUser(Request $request){

        // on récupérer l'entité et on l'entegistre dans la var $propertyCreate
    $NewUser = new User();
    $NewUser->setRoles(['ROLE_ADMIN']);
    //on utilise la methode createForm sur l'entité récupéré
    $formCreateNewUser = $this->createForm(UserType::class, $NewUser );
    $formCreateNewUser->handleRequest($request);
    
    if ($formCreateNewUser->isSubmitted() && $formCreateNewUser->isValid()) {
    
        $em = $this->getDoctrine()->getManager();

        $em->persist($NewUser);
        $em->flush();
        $this->addFlash('success', 'Votre compte a été crée avec succès');
        // Dans redirectToRoute on doit mettre le nom de la route
        return $this->redirectToRoute('index');
    }


    dump($NewUser ->getRoles());



    return $this->render('Inscription/Inscription.html.twig', [
        'controller_name' => 'InscriptionController',
        'form' => $formCreateNewUser->createView(),
    ]);
    }
}

?>

