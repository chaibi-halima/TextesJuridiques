<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\SousCategorie1;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Souscategorie1 controller.
 *
 */
class SousCategorie1Controller extends Controller
{
    /**
     * Lists all sousCategorie1 entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $sousCategorie1s = $em->getRepository('CultureJuridiqueBundle:SousCategorie1')->findAll();

        return $this->render('CultureJuridiqueBundle:souscategorie1:index.html.twig', array(
                    'sousCategorie1s' => $sousCategorie1s,
        ));
    }

    /**
     * Creates a new sousCategorie1 entity.
     *
     */
    public function newAction(Request $request) {
        $sousCategorie1 = new sousCategorie1();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\SousCategorie1Type', $sousCategorie1);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousCategorie1);
            $em->flush();

            return $this->redirectToRoute('souscategorie1_index');
        }

        return $this->render('CultureJuridiqueBundle:souscategorie1:new.html.twig', array(
                    'sousCategorie1' => $sousCategorie1,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sousCategorie1 entity.
     *
     */
    public function showAction(Request $request, sousCategorie1 $sousCategorie1) {
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\SousCategorie1Type', $sousCategorie1);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:souscategorie1:show.html.twig', array(
                    'sousCategorie1' => $sousCategorie1,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sousCategorie1 entity.
     *
     */
    public function editAction(Request $request, sousCategorie1 $sousCategorie1) {
     
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\SousCategorie1Type', $sousCategorie1);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('souscategorie1_index');
        }

        return $this->render('CultureJuridiqueBundle:souscategorie1:edit.html.twig', array(
                    'sousCategorie1' => $sousCategorie1,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a sousCategorie1 entity.
     *
     */
    public function deleteAction(Request $request, sousCategorie1 $sousCategorie1) {
       
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\SousCategorie1Type', $sousCategorie1);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sousCategorie1);
            $em->flush();
            return $this->redirectToRoute('souscategorie1_index');
        }

        return $this->render('CultureJuridiqueBundle:souscategorie1:delete.html.twig', array(
                    'sousCategorie1' => $sousCategorie1,
                    'form' => $deleteForm->createView(),
        ));
    }

}
