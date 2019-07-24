<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\Constitution;
use Culture\JuridiqueBundle\Entity\TexteJuridique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;
use app\Service\FileUploader;
use Culture\JuridiqueBundle\Form\TexteJuridiqueType;
use Culture\JuridiqueBundle\Form\TypeTexteType;
use Culture\JuridiqueBundle\Form\jortType;
use Culture\JuridiqueBundle\Form\StatutTexteType;
use Culture\JuridiqueBundle\Form\TextesRechercheType;

/**
 * Constitution controller.
 *
 */
class ConstitutionController extends Controller {

    /**
     * Lists all Constitution entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $constitutions = $em->getRepository('CultureJuridiqueBundle:Constitution')->findAll();

        return $this->render('CultureJuridiqueBundle:Constitution:index.html.twig', array(
                    'constitutions' => $constitutions,
        ));
    }

    /**
     * Creates a new Constitution entity.
     *
     */
    public function newAction(Request $request) {
        $constitution = new Constitution();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\ConstitutionType', $constitution);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $file = $constitution->getBrochure();
            $fileName = $fileUploader->upload($file);

            $constitution->setBrochure($fileName);

            /*$file = $constitution->getBrochure();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_Constitution_directory'), $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $constitution->setBrochure($fileName);*/
            $em = $this->getDoctrine()->getManager();
            $em->persist($constitution);
            $em->flush();

            return $this->redirectToRoute('constitution_index');
        }

        return $this->render('CultureJuridiqueBundle:Constitution:new.html.twig', array(
                    'constitution' => $constitution,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Constitution entity.
     *
     */
    public function showAction(Request $request, Constitution $constitution) {
        $constitution->setBrochure(
                new File($this->getParameter('brochures_Constitution_directory') . '/' . $constitution->getBrochure()));
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\ConstitutionType', $constitution);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:Constitution:show.html.twig', array(
                    'constitution' => $constitution,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Constitution entity.
     *
     */
    public function editAction(Request $request, Constitution $constitution) {
       
        $constitution->setBrochure(
                new File($this->getParameter('brochures_Constitution_directory') . '/' . $constitution->getBrochure()));
         
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\ConstitutionType', $constitution);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $constitution->getBrochure();
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_Constitution_directory'), $fileName
            );

            // Generate a unique name for the file before saving it
           
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $constitution->setBrochure($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('constitution_index');
        }

        return $this->render('CultureJuridiqueBundle:Constitution:edit.html.twig', array(
                    'constitution' => $constitution,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a Constitution entity.
     *
     */
    public function deleteAction(Request $request, Constitution $constitution) {
        $constitution->setBrochure(
                new File($this->getParameter('brochures_Constitution_directory') . '/' . $constitution->getBrochure()));
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\ConstitutionType', $constitution);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($constitution);
            $em->flush();
            return $this->redirectToRoute('constitution_index');
        }

        return $this->render('CultureJuridiqueBundle:Constitution:delete.html.twig', array(
                    'constitution' => $constitution,
                    'form' => $deleteForm->createView(),
        ));
    }

    /**
     * Details of a Constitution entity.
     *
     */
    public function detailsAction(Request $request, Constitution $constitution) {

        $texteJuridique = new TexteJuridique();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\TextesRechercheType', $texteJuridique);
        $request = $this->getRequest();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            //On récupère les données entrées dans le formulaire par l'utilisateur

            $data = $this->getRequest()->request->get('culture_juridiquebundle_recherchetextes');

            //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire

            $liste_textes = $em->getRepository('CultureJuridiqueBundle:textejuridique')->findTexteByParametres($data);

            //Puis on redirige vers la page de visualisation de cette liste d'annonces

            return $this->render('CultureFrontBundle:Default:listeTextes.html.twig', array('form' => $form->createView(),
                        'liste_textes' => $liste_textes));
        }


        $em = $this->getDoctrine()->getManager();

        $constitutions = $em->getRepository('CultureJuridiqueBundle:Constitution')->findOrdrebByDate();



        return $this->render('CultureJuridiqueBundle:constitution:details.html.twig', array(
                    'constitution' => $constitution,
                    'form' => $form->createView(),
                    'constitutions' => $constitutions
        ));
    }

}
