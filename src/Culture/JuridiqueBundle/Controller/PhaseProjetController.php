<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\PhaseProjet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * Phaseprojet controller.
 *
 */
class PhaseProjetController extends Controller
{
    /**
     * Lists all phaseProjet entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $phaseProjets = $em->getRepository('CultureJuridiqueBundle:PhaseProjet')->findAll();

        return $this->render('CultureJuridiqueBundle:phaseprojet:index.html.twig', array(
            'phaseProjets' => $phaseProjets,
        ));
    }

    /**
     * Creates a new phaseProjet entity.
     *
     */
    public function newAction(Request $request)
    {
        $phaseProjet = new Phaseprojet();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\PhaseProjetType', $phaseProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phaseProjet);
            $em->flush();

            return $this->redirectToRoute('phaseprojet_index');
        }

        return $this->render('CultureJuridiqueBundle:phaseprojet:new.html.twig', array(
            'phaseProjet' => $phaseProjet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a phaseProjet entity.
     *
     */
    public function showAction(Request $request, PhaseProjet $phaseProjet)
    {
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\PhaseProjetType', $phaseProjet);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:phaseprojet:show.html.twig', array(
                    'phaseProjet' => $phaseProjet,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing phaseProjet entity.
     *
     */
    public function editAction(Request $request, PhaseProjet $phaseProjet)
    {
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\PhaseProjetType', $phaseProjet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('phaseprojet_index');
        }

        return $this->render('CultureJuridiqueBundle:phaseprojet:edit.html.twig', array(
                    'phaseProjet' => $phaseProjet,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a phaseProjet entity.
     *
     */
    public function deleteAction(Request $request, PhaseProjet $phaseProjet)
    {
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\PhaseProjetType', $phaseProjet);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($phaseProjet);
            $em->flush();
            return $this->redirectToRoute('phaseprojet_index');
        }

        return $this->render('CultureJuridiqueBundle:phaseprojet:delete.html.twig', array(
                    'phaseProjet' => $phaseProjet,
                    'form' => $deleteForm->createView(),
        ));
    }

}
