<?php

namespace Culture\JuridiqueBundle\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Culture\JuridiqueBundle\Entity\SousCategorie2;
use Culture\JuridiqueBundle\Form\SousCategorie2Type;

use Culture\JuridiqueBundle\Entity\Domaine;
use Culture\JuridiqueBundle\Form\DomaineType;

use Culture\JuridiqueBundle\Entity\SousCategorie1;
use Culture\JuridiqueBundle\Form\SousCategorie1Type;

/**
 * Souscategorie2 controller.
 *
 */
class SousCategorie2Controller extends Controller
{
    /**
     * Lists all sousCategorie2 entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $sousCategorie2s = $em->getRepository('CultureJuridiqueBundle:SousCategorie2')->findAll();

        return $this->render('CultureJuridiqueBundle:souscategorie2:index.html.twig', array(
                    'sousCategorie2s' => $sousCategorie2s,
        ));
    }

    /**
     * Creates a new sousCategorie2 entity.
     *
     */
    public function newAction(Request $request) {
        
        
        $sousCategorie2 = new sousCategorie2();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\SousCategorie2Type', $sousCategorie2);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($sousCategorie2);
            $em->flush();

            return $this->redirectToRoute('souscategorie2_index');
        }

        return $this->render('CultureJuridiqueBundle:souscategorie2:new.html.twig', array(
                    'sousCategorie2' => $sousCategorie2,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a sousCategorie2 entity.
     *
     */
    public function showAction(Request $request, sousCategorie2 $sousCategorie2) {
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\SousCategorie2Type', $sousCategorie2);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:souscategorie2:show.html.twig', array(
                    'sousCategorie2' => $sousCategorie2,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing sousCategorie2 entity.
     *
     */
    public function editAction(Request $request, sousCategorie2 $sousCategorie2) {
     
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\SousCategorie2Type', $sousCategorie2);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('souscategorie2_index');
        }

        return $this->render('CultureJuridiqueBundle:souscategorie2:edit.html.twig', array(
                    'sousCategorie2' => $sousCategorie2,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a sousCategorie2 entity.
     *
     */
    public function deleteAction(Request $request, sousCategorie2 $sousCategorie2) {
       
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\SousCategorie2Type', $sousCategorie2);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($sousCategorie2);
            $em->flush();
            return $this->redirectToRoute('souscategorie2_index');
        }

        return $this->render('CultureJuridiqueBundle:souscategorie2:delete.html.twig', array(
                    'sousCategorie2' => $sousCategorie2,
                    'form' => $deleteForm->createView(),
        ));
    }

}
