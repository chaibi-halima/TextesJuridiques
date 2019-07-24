<?php
class ChangeLocaleController extends Controller {

/**
 * Change the locale for the current user
 *
 * @param String $language
 * @return array
 *
 * @Route("/setlocale/{language}", name="setlocale")
 * @Template()
 */
public function setLocaleAction($language = null)
{
    if($language != null)
    {
        // On enregistre la langue en session
        $this->get('session')->set('_locale', $language);
    }
 
    // on tente de rediriger vers la page d'origine
    $url = $this->container->get('request')->headers->get('referer');
    if(empty($url))
    {
        $url = $this->container->get('router')->generate('index');
    }
 
    return new RedirectResponse($url);
}
}