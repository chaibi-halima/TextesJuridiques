<?php
// src/Culture/JuridiqueBundle/Controller/AdvertController.php

namespace Culture\JuridiqueBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\File\File;

class AdvertController extends Controller
{
  public function translationAction($name)
  {
      // On récupère le service translator
$translator = $this->get('translator');

// Pour traduire dans la locale de l'utilisateur :
$texteTraduit = $translator->trans($name);
    return $this->render('CultureJuridiqueBundle:Advert:translation.html.twig', array(
      'name' => $texteTraduit
    ));
  }
}