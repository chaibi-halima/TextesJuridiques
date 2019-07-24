<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\Direction;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Direction controller.
 *
 */
class DirectionController extends Controller {

    /**
     * Lists all direction entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $directions = $em->getRepository('CultureJuridiqueBundle:Direction')->findAll();

        return $this->render('CultureJuridiqueBundle:direction:index.html.twig', array(
                    'directions' => $directions,
        ));
    }

    /**
     * Creates a new direction entity.
     *
     */
    public function newAction(Request $request) {
        $direction = new Direction();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\DirectionType', $direction);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($direction);
            $em->flush();

            return $this->redirectToRoute('direction_index');
        }

        return $this->render('CultureJuridiqueBundle:direction:new.html.twig', array(
                    'direction' => $direction,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a direction entity.
     *
     */
    public function showAction(Request $request, Direction $direction) {
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\DirectionType', $direction);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:direction:show.html.twig', array(
                    'direction' => $direction,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing direction entity.
     *
     */
    public function editAction(Request $request, Direction $direction) {
     
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\DirectionType', $direction);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('direction_index');
        }

        return $this->render('CultureJuridiqueBundle:direction:edit.html.twig', array(
                    'direction' => $direction,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a direction entity.
     *
     */
    public function deleteAction(Request $request, Direction $direction) {
       
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\DirectionType', $direction);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($direction);
            $em->flush();
            return $this->redirectToRoute('direction_index');
        }

        return $this->render('CultureJuridiqueBundle:direction:delete.html.twig', array(
                    'direction' => $direction,
                    'form' => $deleteForm->createView(),
        ));
    }

   

}
