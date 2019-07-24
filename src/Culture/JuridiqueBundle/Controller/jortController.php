<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\jort;
use Culture\JuridiqueBundle\Entity\TexteJuridique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Jort controller.
 *
 */
class jortController extends Controller {

    /**
     * Lists all jort entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $jorts = $em->getRepository('CultureJuridiqueBundle:jort')->findAll();

        return $this->render('CultureJuridiqueBundle:jort:index.html.twig', array(
                    'jorts' => $jorts,
        ));
    }

    /**
     * Creates a new jort entity.
     *
     */
    public function newAction(Request $request) {
        $jort = new Jort();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\jortType', $jort);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $jort->getBrochure();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_jort_directory'), $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $jort->setBrochure($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($jort);
            $em->flush();

            return $this->redirectToRoute('jort_index');
        }

        return $this->render('CultureJuridiqueBundle:jort:new.html.twig', array(
                    'jort' => $jort,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a jort entity.
     *
     */
    public function showAction(Request $request, jort $jort) {
        $jort->setBrochure(
                new File($this->getParameter('brochures_jort_directory') . '/' . $jort->getBrochure()));
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\jortType', $jort);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:jort:show.html.twig', array(
                    'jort' => $jort,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing jort entity.
     *
     */
    public function editAction(Request $request, jort $jort) {
        $jort->setBrochure(
                new File($this->getParameter('brochures_jort_directory') . '/' . $jort->getBrochure()));
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\jortType', $jort);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $jort->getBrochure();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_jort_directory'), $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $jort->setBrochure($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('jort_index');
        }

        return $this->render('CultureJuridiqueBundle:jort:edit.html.twig', array(
                    'jort' => $jort,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a jort entity.
     *
     */
    public function deleteAction(Request $request, jort $jort) {
        $jort->setBrochure(
                new File($this->getParameter('brochures_jort_directory') . '/' . $jort->getBrochure()));
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\jortType', $jort);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($jort);
            $em->flush();
            return $this->redirectToRoute('jort_index');
        }

        return $this->render('CultureJuridiqueBundle:jort:delete.html.twig', array(
                    'jort' => $jort,
                    'form' => $deleteForm->createView(),
        ));
    }

    /**
     * Details of a JORT entity.
     *
     */
    public function detailsAction(Request $request, jort $jort) {
        $texteJuridique = new Textejuridique();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\TextesRechercheType', $texteJuridique);
        $request = $this->getRequest();
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findAllJort($jort);

        return $this->render('CultureFrontBundle:Default:listeActualitesJort.html.twig', array
                    ('form' => $form->createView(),
                    'texteJuridiques' => $texteJuridiques,
                    'jort' => $jort));
    }

}
