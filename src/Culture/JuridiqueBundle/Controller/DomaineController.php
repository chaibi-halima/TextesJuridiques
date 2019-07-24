<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\Domaine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Domaine controller.
 *
 */
class DomaineController extends Controller {

    /**
     * Lists all domaine entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $domaines = $em->getRepository('CultureJuridiqueBundle:Domaine')->findAll();

        return $this->render('CultureJuridiqueBundle:domaine:index.html.twig', array(
                    'domaines' => $domaines,
        ));
    }

    /**
     * Creates a new domaine entity.
     *
     */
    public function newAction(Request $request) {
        $domaine = new Domaine();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\DomaineType', $domaine);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($domaine);
            $em->flush();

            return $this->redirectToRoute('domaine_index');
        }

        return $this->render('CultureJuridiqueBundle:domaine:new.html.twig', array(
                    'domaine' => $domaine,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a domaine entity.
     *
     */
    public function showAction(Request $request, Domaine $domaine) {
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\DomaineType', $domaine);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:domaine:show.html.twig', array(
                    'domaine' => $domaine,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing domaine entity.
     *
     */
    public function editAction(Request $request, Domaine $domaine) {
     
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\DomaineType', $domaine);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('domaine_index');
        }

        return $this->render('CultureJuridiqueBundle:domaine:edit.html.twig', array(
                    'domaine' => $domaine,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a domaine entity.
     *
     */
    public function deleteAction(Request $request, Domaine $domaine) {
       
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\DomaineType', $domaine);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($domaine);
            $em->flush();
            return $this->redirectToRoute('domaine_index');
        }

        return $this->render('CultureJuridiqueBundle:domaine:delete.html.twig', array(
                    'domaine' => $domaine,
                    'form' => $deleteForm->createView(),
        ));
    }

   

}
