<?php

namespace Culture\JuridiqueBundle\Controller;

use Symfony\Component\HttpFoundation\File\File;
use Culture\JuridiqueBundle\Entity\ProjetLoi;
use Culture\JuridiqueBundle\Entity\TexteJuridique;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

use Culture\JuridiqueBundle\Form\ProjetLoiType;
/**
 * Projetloi controller.
 *
 */
class ProjetLoiController extends Controller
{
    /**
     * Lists all projetLoi entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projetLois = $em->getRepository('CultureJuridiqueBundle:ProjetLoi')->findAll();

        return $this->render('CultureJuridiqueBundle:projetloi:index.html.twig', array(
            'projetLois' => $projetLois,
        ));
    }

    /**
     * Creates a new projetLoi entity.
     *
     */
    public function newAction(Request $request)
    {
        $projetLoi = new Projetloi();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\ProjetLoiType', $projetLoi);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            
            $file = $projetLoi->getBrochure();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_projet_directory'), $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $projetLoi->setBrochure($fileName);
            
            $em = $this->getDoctrine()->getManager();
            $em->persist($projetLoi);
            $em->flush();

            return $this->redirectToRoute('projetloi_index');
        }

        return $this->render('CultureJuridiqueBundle:projetloi:new.html.twig', array(
            'projetLoi' => $projetLoi,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a projetLoi entity.
     *
     */
    public function showAction(Request $request,ProjetLoi $projetLoi)
    {
        $projetLoi->setBrochure(
                new File($this->getParameter('brochures_projet_directory') . '/' . $projetLoi->getBrochure()));
        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\ProjetLoiType', $projetLoi);
        $showForm->handleRequest($request);

        return $this->render('CultureJuridiqueBundle:projetloi:show.html.twig', array(
                    'projetLoi' => $projetLoi,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing projetLoi entity.
     *
     */
    public function editAction(Request $request, ProjetLoi $projetLoi)
    {
        $projetLoi->setBrochure(
                new File($this->getParameter('brochures_projet_directory') . '/' . $projetLoi->getBrochure()));
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\ProjetLoiType', $projetLoi);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            
            $file = $projetLoi->getBrochure();
            // Generate a unique name for the file before saving it
            $fileName = md5(uniqid()) . '.' . $file->guessExtension();
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_projet_directory'), $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $projetLoi->setBrochure($fileName);
            
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('projetloi_index');
        }

        return $this->render('CultureJuridiqueBundle:projetloi:edit.html.twig', array(
            'projetLoi' => $projetLoi,
            'form' => $editForm->createView(),
        ));
        
    }

    /**
     * Deletes a projetLoi entity.
     *
     */
    public function deleteAction(Request $request, ProjetLoi $projetLoi)
    {
        $projetLoi->setBrochure(
                new File($this->getParameter('brochures_projet_directory') . '/' . $projetLoi->getBrochure()));
        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\ProjetLoiType', $projetLoi);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($projetLoi);
            $em->flush();
            return $this->redirectToRoute('projetloi_index');
        }

        return $this->render('CultureJuridiqueBundle:projetloi:delete.html.twig', array(
                    'projetLoi' => $projetLoi,
                    'form' => $deleteForm->createView(),
        ));
    }
    
     /**
     * Details of a Projet Loi entity.
     *
     */
    public function detailsAction(Request $request, ProjetLoi $projetLoi) {
        $texteJuridique = new Textejuridique();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\TextesRechercheType', $texteJuridique);
        $request = $this->getRequest();
        $form->handleRequest($request);

        $em = $this->getDoctrine()->getManager();
        $projetLois = $em->getRepository('CultureJuridiqueBundle:ProjetLoi')->findAll();

       return $this->render('CultureJuridiqueBundle:ProjetLoi:details.html.twig', array(
                    'projetLoi' => $projetLoi,
                    'form' => $form->createView(),
                    'projetLois' => $projetLois
        ));
    }

   
}
