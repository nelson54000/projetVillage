<?php

namespace App\Controller;

use App\Entity\Contact2;
use App\Form\Contact2Type;
use App\Repository\Contact2Repository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/contact2")
 */
class Contact2Controller extends AbstractController
{
    /**
     * @Route("/", name="contact2_index", methods={"GET"})
     */
    public function index(Contact2Repository $contact2Repository): Response
    {
        return $this->render('contact2/index.html.twig', [
            'contact2s' => $contact2Repository->findAll(),
        ]);
    }

    /**
     * @Route("/new", name="contact2_new", methods={"GET","POST"})
     */
    public function new(Request $request): Response
    {
        $contact2 = new Contact2();
        $form = $this->createForm(Contact2Type::class, $contact2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($contact2);
            $entityManager->flush();

            return $this->redirectToRoute('contact2_index');
        }

        return $this->render('contact2/new.html.twig', [
            'contact2' => $contact2,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}", name="contact2_show", methods={"GET"})
     */
    public function show(Contact2 $contact2): Response
    {
        return $this->render('contact2/show.html.twig', [
            'contact2' => $contact2,
        ]);
    }


    /**
     * @Route("/{id}", name="contact2_delete", methods={"DELETE"})
     */
    public function delete(Request $request, Contact2 $contact2): Response
    {
        if ($this->isCsrfTokenValid('delete'.$contact2->getId(), $request->request->get('_token'))) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->remove($contact2);
            $entityManager->flush();
        }

        return $this->redirectToRoute('contact2_index');
    }
}
