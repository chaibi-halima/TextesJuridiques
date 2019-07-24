<?php

namespace Culture\JuridiqueBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\File\File;
use Culture\JuridiqueBundle\Entity\TexteJuridique;
use Culture\JuridiqueBundle\Form\TexteJuridiqueType;
use Culture\JuridiqueBundle\Form\TypeTexteType;
use Culture\JuridiqueBundle\Form\jortType;
use Culture\JuridiqueBundle\Form\StatutTexteType;
use Culture\JuridiqueBundle\Form\TextesRechercheType;
use Doctrine\ORM\Mapping as ORM;

use Symfony\Component\Form\FormBuilder;

/**
 * Textejuridique controller.
 *
 */
class TexteJuridiqueController extends Controller {

    /**
     * Lists all texteJuridique entities.
     *
     */
    public function indexAction() {
        $em = $this->getDoctrine()->getManager();

        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findAll();

        return $this->render('CultureJuridiqueBundle:textejuridique:index.html.twig', array(
                    'texteJuridiques' => $texteJuridiques,
        ));
    }

    public function searchAction() {


        $texteJuridique = new Textejuridique();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\TextesRechercheType', $texteJuridique);
        $request = $this->getRequest();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            //On récupère les données entrées dans le formulaire par l'utilisateur

            $data = $this->getRequest()->request->get('culture_juridiquebundle_recherchetextes');

            //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire

            $liste_textes = $em->getRepository('CultureJuridiqueBundle:textejuridique')->findTexteByParametres($data);

            //Puis on redirige vers la page de visualisation de cette liste d'annonces

            return $this->render('CultureJuridiqueBundle:textejuridique:listeTextes.html.twig', array('liste_textes' => $liste_textes));
        }


        // À ce stade :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau

        return $this->render('CultureJuridiqueBundle:textejuridique:form.html.twig', array('form' => $form->createView()));
    }

    /**
     * Creates a new texteJuridique entity.
     *
     */
    public function newAction(Request $request) {

        $texteJuridique = new Textejuridique();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\TexteJuridiqueType', $texteJuridique);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // $file stores the uploaded PDF file
            
            $file = $texteJuridique->getBrochure();
            // Generate a unique name for the file before saving it
            $fileName = $file->getClientOriginalName(); 
            // Move the file to the directory where brochures are stored
            $file->move(
                    $this->getParameter('brochures_directory'), $fileName
            );
            // Update the 'brochure' property to store the PDF file name
            // instead of its contents
            $texteJuridique->setBrochure($fileName);

            $em = $this->getDoctrine()->getManager();
            $em->persist($texteJuridique);
            $em->flush();
            return $this->redirectToRoute('textejuridique_index');
        }

        return $this->render('CultureJuridiqueBundle:textejuridique:new.html.twig', array(
                    'texteJuridique' => $texteJuridique,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a texteJuridique entity.
     *
     */
    public function showAction(Request $request, TexteJuridique $texteJuridique) {

        $texteJuridique->setBrochure(
                new File($this->getParameter('brochures_directory') . '/' . $texteJuridique->getBrochure()));

        $showForm = $this->createForm('Culture\JuridiqueBundle\Form\TexteJuridiqueType', $texteJuridique);
        $showForm->handleRequest($request);

        if ($showForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($texteJuridique);
            $em->flush();
            return $this->redirectToRoute('textejuridique_index');
        }

        return $this->render('CultureJuridiqueBundle:textejuridique:show.html.twig', array(
                    'texteJuridique' => $texteJuridique,
                    'form' => $showForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing texteJuridique entity.
     *
     */
    public function editAction(Request $request, TexteJuridique $texteJuridique) {

        $file=$texteJuridique->getBrochure();
        $texteJuridique->setBrochure(
            new File($this->getParameter('brochures_directory') . '/' . $texteJuridique->getBrochure()));
        
        /*$texteJuridique->setBrochure($file);*/
                
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\TexteJuridiqueType', $texteJuridique);
        
        $editForm->handleRequest($request);
        
       

        if ($editForm->isSubmitted() && $editForm->isValid()) {

            if($texteJuridique->getBrochure()=="")
            {
                $texteJuridique->setBrochure($file);
            }

            else 
            {
                
                $file = $texteJuridique->getBrochure();
                // Generate a unique name for the file before saving it
                $fileName = $file->getClientOriginalName(); 
                // Move the file to the directory where brochures are stored
                $file->move(
                        $this->getParameter('brochures_directory'), $fileName
                );
    
                // Update the 'brochure' property to store the PDF file name
                // instead of its contents
                $texteJuridique->setBrochure($fileName);
            }
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('textejuridique_index');
        }

        return $this->render('CultureJuridiqueBundle:textejuridique:edit.html.twig', array(
                    'texteJuridique' => $texteJuridique,
                    'form' => $editForm->createView(),
        ));
    }

    /**
     * Deletes a texteJuridique entity.
     *
     */
    public function deleteAction(Request $request, TexteJuridique $texteJuridique) {

        $texteJuridique->setBrochure(
                new File($this->getParameter('brochures_directory') . '/' . $texteJuridique->getBrochure()));

        $deleteForm = $this->createForm('Culture\JuridiqueBundle\Form\TexteJuridiqueType', $texteJuridique);
        $deleteForm->handleRequest($request);

        if ($deleteForm->isSubmitted() && $deleteForm->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($texteJuridique);
            $em->flush();
            return $this->redirectToRoute('textejuridique_index');
        }

        return $this->render('CultureJuridiqueBundle:textejuridique:delete.html.twig', array(
                    'texteJuridique' => $texteJuridique,
                    'form' => $deleteForm->createView(),
        ));
    }

    /**
     * Details of a texteJuridique entity.
     *
     * 
     */
    public function detailsAction(Request $request, TexteJuridique $texteJuridique) {

        $form = $this->createForm('Culture\JuridiqueBundle\Form\TextesRechercheType', $texteJuridique);
        $request = $this->getRequest();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            //On récupère les données entrées dans le formulaire par l'utilisateur

            $data = $this->getRequest()->request->get('culture_juridiquebundle_recherchetextes');

            //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire

            $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:textejuridique')->findTexteByParametres($data);

            //Puis on redirige vers la page de visualisation de cette liste d'annonces

           return $this->render('CultureFrontBundle:Default:listeActualites.html.twig', array
                ('form' => $form->createView(),
                    'texteJuridiques' => $texteJuridiques,
                    'menu' => 4));
        }


        $em = $this->getDoctrine()->getManager();
        if($texteJuridique->getDownload()>0)$texteJuridique->setDownload($texteJuridique->getDownload()-1);
        $em->persist($texteJuridique);
        $em->flush();
        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findOrdrebByDate();

        return $this->render('CultureJuridiqueBundle:textejuridique:details.html.twig', array(
                    'texteJuridique' => $texteJuridique,
                    'form' => $form->createView(),
                    'texteJuridiques' => $texteJuridiques
        ));
    }

    public function downloadAction(Request $request, TexteJuridique $texteJuridique) {

        $form = $this->createForm('Culture\JuridiqueBundle\Form\TextesRechercheType', $texteJuridique);
        $request = $this->getRequest();
        $form->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        if($texteJuridique->getCompteur()>0) $texteJuridique->setCompteur($texteJuridique->getCompteur()-1);
        $em->persist($texteJuridique);
        $em->flush();
        $texteJuridique->increaseDownload();
        
        
        $file = $texteJuridique->getBrochure();
        $chemin = "../web/uploads/brochures/";


        $response = new Response();
        $response->setContent($texteJuridique->getDownload()-1);
       
        return $response;
      
    }

    /**
     * Details of a JORT entity.
     *
     */
    public function detailsJortAction(Request $request) {

        $numJort =$request->attributes->get('id');
        $dateJort=$request->attributes->get('dateJort');

        $texteJuridique = new Textejuridique();
        $form = $this->createForm('Culture\JuridiqueBundle\Form\TextesRechercheType', $texteJuridique);
        $request = $this->getRequest();
        $form->handleRequest($request);

        if ($form->isSubmitted()) {

            $em = $this->getDoctrine()->getManager();

            //On récupère les données entrées dans le formulaire par l'utilisateur

            $data = $this->getRequest()->request->get('culture_juridiquebundle_recherchetextes');

            //On va récupérer la méthode dans le repository afin de trouver toutes les annonces filtrées par les paramètres du formulaire

            $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:textejuridique')->findTexteByParametres($data);

            //Puis on redirige vers la page de visualisation de cette liste d'annonces

           return $this->render('CultureFrontBundle:Default:listeActualites.html.twig', array
                ('form' => $form->createView(),
                    'texteJuridiques' => $texteJuridiques,
                    'menu' => 4));
        }


        $em = $this->getDoctrine()->getManager();
        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findAllJort($numJort,$dateJort);

        return $this->render('CultureFrontBundle:Default:listeActualitesJort.html.twig', array
                    ('form' => $form->createView(),
                    'texteJuridiques' => $texteJuridiques,
                    'jort' => $numJort,
                    'dateJort'=> $dateJort));
    }


}
