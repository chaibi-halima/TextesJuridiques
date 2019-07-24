<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\CahierCharge;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Cahiercharge controller.
 *
 */
class CahierChargeController extends Controller
{
    /**
     * Lists all cahierCharge entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $cahierCharges = $em->getRepository('CultureJuridiqueBundle:CahierCharge')->findAll();

        return $this->render('CultureJuridiqueBundle:cahiercharge:index.html.twig', array(
            'cahierCharges' => $cahierCharges,
        ));
    }

    /**
     * Creates a new cahierCharge entity.
     *
     */
    public function newAction(Request $request)
    {
        $cahierCharge = new CahierCharge();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\CahierChargeType', $cahierCharge);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $cahierCharge->getBrochure();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_cahiercharge_directory'), $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $cahierCharge->setBrochure($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($cahierCharge);
            $em->flush();

            return $this->redirectToRoute('cahiercharge_index');
        }

        return $this->render('CultureJuridiqueBundle:cahiercharge:new.html.twig', array(
            'cahierCharge' => $cahierCharge,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a cahierCharge entity.
     *
     */
    public function showAction(Request $request,CahierCharge $cahierCharge)
    {
        $cahierCharge->setBrochure(
                new File($this->getParameter('brochures_cahiercharge_directory') . '/' . $cahierCharge->getBrochure()));
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\CahierChargeType', $cahierCharge);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:cahiercharge:show.html.twig', array(
                    'cahierCharge' => $cahierCharge,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing cahierCharge entity.
     *
     */
    public function editAction(Request $request, CahierCharge $cahierCharge)
    {
        $cahierCharge->setBrochure(
                new File($this->getParameter('brochures_cahiercharge_directory') . '/' . $cahierCharge->getBrochure()));
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\CahierChargeType', $cahierCharge);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $cahierCharge->getBrochure();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_cahiercharge_directory'), $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $cahierCharge->setBrochure($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('cahiercharge_index');
        }

        return $this->render('CultureJuridiqueBundle:cahiercharge:edit.html.twig', array(
                    'cahierCharge' => $cahierCharge,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a cahierCharge entity.
     *
     */
    public function deleteAction(Request $request, CahierCharge $cahierCharge)
    {
        $cahierCharge->setBrochure(
                new File($this->getParameter('brochures_cahiercharge_directory') . '/' . $cahierCharge->getBrochure()));
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\CahierChargeType', $cahierCharge);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($cahierCharge);
            $em->flush();
            return $this->redirectToRoute('cahiercharge_index');
        }

        return $this->render('CultureJuridiqueBundle:cahiercharge:delete.html.twig', array(
                    'cahierCharge' => $cahierCharge,
                    'form' => $deleteForm->createView(),
        ));
    }

    
}
