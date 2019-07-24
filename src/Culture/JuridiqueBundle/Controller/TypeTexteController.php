<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\TypeTexte;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Culture\JuridiqueBundle\Form\TypeTexteType;
/**
 * Typetexte controller.
 *
 */
class TypeTexteController extends Controller {

    /**
     * Lists all typeTexte entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $typeTextes = $em->getRepository('CultureJuridiqueBundle:TypeTexte')->findAll();

        return $this->render('CultureJuridiqueBundle:typetexte:index.html.twig', array(
                    'typeTextes' => $typeTextes,
        ));
    }

    /**
     * Creates a new typeTexte entity.
     *
     */
    public function newAction(Request $request) {
        $em = $this->getDoctrine()->getManager();
        $typeTexte = new Typetexte();
        $form = $this->createForm(new TypeTexteType($em, $request), $typeTexte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($typeTexte);
            $em->flush();

            return $this->redirectToRoute('typetexte_index');
        }

        return $this->render('CultureJuridiqueBundle:typetexte:new.html.twig', array(
                    'typeTexte' => $typeTexte,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a typeTexte entity.
     *
     */
    public function showAction(Request $request, TypeTexte $typeTexte) {
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\TypeTexteType', $typeTexte);
        $showForm->handleRequest($request);

        if ($showForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeTexte);
            $em->flush();
            return $this->redirectToRoute('$typeTexte_index');
        }

        return $this->render('CultureJuridiqueBundle:typeTexte:show.html.twig', array(
                    'typeTexte' => $typeTexte,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing typeTexte entity.
     *
     */
    public function editAction(Request $request, TypeTexte $typeTexte) {

        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\TypeTexteType', $typeTexte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('typetexte_index');
        }

        return $this->render('CultureJuridiqueBundle:typetexte:edit.html.twig', array(
                    'typeTexte' => $typeTexte,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a typeTexte entity.
     *
     */
    public function deleteAction(Request $request, TypeTexte $typeTexte) {
        
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\TypeTexteType', $typeTexte);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($typeTexte);
            $em->flush();
            return $this->redirectToRoute('typetexte_index');
        }

        return $this->render('CultureJuridiqueBundle:typeTexte:delete.html.twig', array(
                    'typeTexte' => $typeTexte,
                    'form' => $deleteForm->createView(),
        ));
    }

}
