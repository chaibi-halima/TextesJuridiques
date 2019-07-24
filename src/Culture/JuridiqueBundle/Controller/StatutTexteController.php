<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\StatutTexte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Statuttexte controller.
 *
 */
class StatutTexteController extends Controller {

    /**
     * Lists all statutTexte entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $statutTextes = $em->getRepository('CultureJuridiqueBundle:StatutTexte')->findAll();

        return $this->render('CultureJuridiqueBundle:statuttexte:index.html.twig', array(
                    'statutTextes' => $statutTextes,
        ));
    }

    /**
     * Creates a new statutTexte entity.
     *
     */
    public function newAction(Request $request) {
        $statutTexte = new Statuttexte();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\StatutTexteType', $statutTexte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($statutTexte);
            $em->flush();

            return $this->redirectToRoute('statuttexte_index');
        }

        return $this->render('CultureJuridiqueBundle:statuttexte:new.html.twig', array(
                    'statutTexte' => $statutTexte,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a statutTexte entity.
     *
     */
    public function showAction(Request $request, StatutTexte $statutTexte) {
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\StatutTexteType', $statutTexte);
        $showForm->handleRequest($request);

        if ($showForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statutTexte);
            $em->flush();
            return $this->redirectToRoute('$statutTexte_index');
        }

        return $this->render('CultureJuridiqueBundle:statutTexte:show.html.twig', array(
                    'statutTexte' => $statutTexte,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing statutTexte entity.
     *
     */
    public function editAction(Request $request, StatutTexte $statutTexte) {

        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\StatutTexteType', $statutTexte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('statuttexte_index');
        }

        return $this->render('CultureJuridiqueBundle:statuttexte:edit.html.twig', array(
                    'statutTexte' => $statutTexte,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a statutTexte entity.
     *
     */
    public function deleteAction(Request $request, StatutTexte $statutTexte) {
        
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\StatutTexteType', $statutTexte);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($statutTexte);
            $em->flush();
            return $this->redirectToRoute('statuttexte_index');
        }

        return $this->render('CultureJuridiqueBundle:statutTexte:delete.html.twig', array(
                    'statutTexte' => $statutTexte,
                    'form' => $deleteForm->createView(),
        ));
    }

}
