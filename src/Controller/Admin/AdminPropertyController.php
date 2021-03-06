<?php

namespace App\Controller\Admin;

use App\Form\PropertyType;
use APP\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjetManager;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\String\Slugger\SluggerInterface;

class AdminPropertyController extends AbstractController
{



    public function index()
    {
        $repository = $this->getDoctrine()->getRepository('App\Entity\Property');
        $GetAllRealEstate = $repository->findAll();
        return $this->render('Admin/AdminRealEstate/AdminRealEstateIndex.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'getAllRealEstate' => $GetAllRealEstate,
        ]);
    }

    public function edit($id, Property $property, Request $request)
    {
        $form = $this->createForm(PropertyType::class, $property);
        $form->handleRequest($request);



        if ($form->isSubmitted() && $form->isValid()) {

            $em = $this->getDoctrine()->getManager();
            $em->flush();
            $this->addFlash('success', 'Bien modifié avec succès');
            // Dans redirectToRoute on doit mettre le nom de la route
            return $this->redirectToRoute('AdminRealEstateIndex');
        }

        $repository = $this->getDoctrine()->getRepository('App\Entity\Property');
        $PropertyAtShow = $repository->find($id);
        return $this->render('Admin/AdminRealEstate/EditRealEstate.html.twig', [
            'controller_name' => 'AdminPropertyController',
            'propertyAtShow' => $PropertyAtShow,
            'form' => $form->createView(),
        ]);
    }


    public function create(Request $request)
    {

        // on récupérer l'entité et on l'enregistre dans la var $propertyCreate
        $propertyCreate = new Property();
        //on utilise la methode createForm sur l'entité récupéré
        $form2 = $this->createForm(PropertyType::class, $propertyCreate);
        $form2->handleRequest($request);

        if ($form2->isSubmitted() && $form2->isValid()) {

            $imageFile = $form2->get('imageFile')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                // $safeFilename = $slugger->slug($originalFilename);
                $safeFilename = $originalFilename;

                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                // dump('coucou');
                // Move the file to the directory where brochures are stored
                try {
                    $imageFile->move(
                        $this->getParameter('img_upload_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'brochureFilename' property to store the PDF file name
                // instead of its contents
// dd($newFilename);
                $propertyCreate->setImageFile($newFilename);
                $propertyCreate->setFilename($newFilename);
            }

            $em = $this->getDoctrine()->getManager();
            $em->persist($propertyCreate);
            $em->flush();
            $this->addFlash('success', 'Bien crée avec succès');

            // Dans redirectToRoute on doit mettre le nom de la route
            return $this->redirectToRoute('AdminRealEstateIndex');
        }
        return $this->render('Admin/AdminRealEstate/CreateRealEstate.html.twig', [
            'controller_name' => 'AdminPropertyController',
            // 'propertyAtShow' => $PropertyAtShow,
            'form' => $form2->createView(),
        ]);
    }

    // , Request $request
    public function delete(Property $property)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($property);
        $em->flush();
        $this->addFlash('success', 'Bien supprimé avec succès');
        //  if ($this->isCsrfTokenValid('delete'. $property->getId(), $request->get('_token') )) {

        //  }
        return $this->redirectToRoute('AdminRealEstateIndex');
    }
}
