<?php

namespace Culture\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Culture\JuridiqueBundle\Entity\TexteJuridique;
use Culture\JuridiqueBundle\Entity\jort;
use Culture\JuridiqueBundle\Form\TexteJuridiqueType;
use Culture\JuridiqueBundle\Form\TypeTexteType;
use Culture\JuridiqueBundle\Form\jortType;
use Culture\JuridiqueBundle\Form\StatutTexteType;
use Culture\JuridiqueBundle\Form\TextesRechercheType;

class DefaultController extends Controller {

    public function indexAction() {

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


        // À ce stade :
        // - Soit la requête est de type GET, donc le visiteur vient d'arriver sur la page et veut voir le formulaire
        // - Soit la requête est de type POST, mais le formulaire n'est pas valide, donc on l'affiche de nouveau


        $em = $this->getDoctrine()->getManager();

        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findOrdrebByDate();


        return $this->render('CultureFrontBundle:Default:index.html.twig', array('form' => $form->createView(),
                    'texteJuridiques' => $texteJuridiques));
    }

    public function listeAction() {
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
        $texteJuridiques=null;
        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findOrdrebByDate();
        
       
        return $this->render('CultureFrontBundle:Default:listeActualites.html.twig', array
                ('form' => $form->createView(),
                    'texteJuridiques' => $texteJuridiques,
                    'menu' => 1));
    }
    public function listeConstitutionsAction() {
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

        $constitutions = $em->getRepository('CultureJuridiqueBundle:Constitution')->findOrdrebByDate();

       
        return $this->render('CultureFrontBundle:Default:listeConstitutions.html.twig', array
                ('form' => $form->createView(),
                    'constitutions' => $constitutions));
    }
    
    public function listeJortsAction() {
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
        $texteJuridiques=null;
        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->listeJort();
        
       
        return $this->render('CultureFrontBundle:Default:listeJorts.html.twig', array
                ('form' => $form->createView(),
                    'texteJuridiques' => $texteJuridiques));
    }

    
    public function listeNominationsAction() {
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
        $texteJuridiques=null;
        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findAllNominations();
       
        return $this->render('CultureFrontBundle:Default:listeActualites.html.twig', array
                ('form' => $form->createView(),
                 'texteJuridiques' => $texteJuridiques,
                    'menu' => 2));
    }
    
    public function listeConventionsAction() {
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
        $texteJuridiques=null;
        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findAllConventions();
  
        return $this->render('CultureFrontBundle:Default:listeActualites.html.twig', array
                ('form' => $form->createView(),
                 'texteJuridiques' => $texteJuridiques,
                    'menu' => 3));
    }
   
    public function listeProjetsAction() {
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

        $projets = $em->getRepository('CultureJuridiqueBundle:ProjetLoi')->findOrdrebByDate();

       
        return $this->render('CultureFrontBundle:Default:listeProjets.html.twig', array
                ('form' => $form->createView(),
                    'projets' => $projets));
    }
    
        public function listeCahiersChargesAction() {
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

        $cahiers = $em->getRepository('CultureJuridiqueBundle:CahierCharge')->findAll();

       
        return $this->render('CultureFrontBundle:Default:listeCahiersCharges.html.twig', array
                ('form' => $form->createView(),
                    'cahiers' => $cahiers));
    }
    
    public function listeServicesAction() {
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

        $services = $em->getRepository('CultureJuridiqueBundle:service')->findAll();

       
        return $this->render('CultureFrontBundle:Default:listeServices.html.twig', array
                ('form' => $form->createView(),
                    'services' => $services));
    }

    public function listeCirculairesAction() {
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
        $texteJuridiques=null;
        $texteJuridiques = $em->getRepository('CultureJuridiqueBundle:TexteJuridique')->findAllCirculaires();
  
        return $this->render('CultureFrontBundle:Default:listeActualites.html.twig', array
                ('form' => $form->createView(),
                 'texteJuridiques' => $texteJuridiques,
                    'menu' => 5));
    }
    
}
