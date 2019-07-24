<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\service;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

/**
 * Cahiercharge controller.
 *
 */
class serviceController extends Controller
{
    /**
     * Lists all service entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $services = $em->getRepository('CultureJuridiqueBundle:service')->findAll();

        return $this->render('CultureJuridiqueBundle:service:index.html.twig', array(
            'services' => $services,
        ));
    }

    /**
     * Creates a new service entity.
     *
     */
    public function newAction(Request $request)
    {
        $service = new service();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\serviceType', $service);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $file = $service->getBrochure();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_service_directory'), $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $service->setBrochure($fileName);
            $em = $this->getDoctrine()->getManager();
            $em->persist($service);
            $em->flush();

            return $this->redirectToRoute('service_index');
        }

        return $this->render('CultureJuridiqueBundle:service:new.html.twig', array(
            'service' => $service,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a service entity.
     *
     */
    public function showAction(Request $request,service $service)
    {
        $service->setBrochure(
                new File($this->getParameter('brochures_service_directory') . '/' . $service->getBrochure()));
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\serviceType', $service);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:service:show.html.twig', array(
                    'service' => $service,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing service entity.
     *
     */
    public function editAction(Request $request, service $service)
    {
        $service->setBrochure(
                new File($this->getParameter('brochures_service_directory') . '/' . $service->getBrochure()));
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\serviceType', $service);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $file = $service->getBrochure();

            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();

            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_service_directory'), $fileName
            );

            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $service->setBrochure($fileName);
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('service_index');
        }

        return $this->render('CultureJuridiqueBundle:service:edit.html.twig', array(
                    'service' => $service,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a service entity.
     *
     */
    public function deleteAction(Request $request, service $service)
    {
        $service->setBrochure(
                new File($this->getParameter('brochures_service_directory') . '/' . $service->getBrochure()));
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\serviceType', $service);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($service);
            $em->flush();
            return $this->redirectToRoute('service_index');
        }

        return $this->render('CultureJuridiqueBundle:service:delete.html.twig', array(
                    'service' => $service,
                    'form' => $deleteForm->createView(),
        ));
    }

    
}
