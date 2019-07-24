<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\Post;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;

/**
 * Post controller.
 *
 */
class PostController extends Controller {

    /**
     * Lists all post entities.
     *
     */
    public function indexAction(Request $request) {

        $em = $this->getDoctrine()->getManager();
        $repository = $this
                ->getDoctrine()
                ->getManager()
                ->getRepository('CultureJuridiqueBundle:Post')
        ;

        $posts = $repository->findAll();


        return $this->render('CultureJuridiqueBundle:post:index.html.twig', array(
                    'posts' => $posts,
        ));
    }

    /**
     * Creates a new post entity.
     *
     */
    public function newAction(Request $request) {
        //$locale = $request->getDefaultLocale();
        $locale = $request->getLocale();
        $em = $this->getDoctrine()->getManager();
        $post = new Post($this->container->getParameter($locale));
        $form = $this->createForm(new \Culture\JuridiqueBundle\Form\PostType($em, $request), $post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($post);
            $em->flush();

            return $this->redirectToRoute('post_index');
        }

        return $this->render('CultureJuridiqueBundle:post:new.html.twig', array(
                    'post' => $post,
                    'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a post entity.
     *
     */
    public function showAction(Post $post) {
        $deleteForm = $this->createDeleteForm($post);

        return $this->render('post/show.html.twig', array(
                    'post' => $post,
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing post entity.
     *
     */
    public function editAction(Request $request, Post $post) {
        $deleteForm = $this->createDeleteForm($post);
        $editForm = $this->createForm('Culture\JuridiqueBundle\Form\PostType', $post);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('post_edit', array('id' => $post->getId()));
        }

        return $this->render('CultureJuridiqueBundle:post:edit.html.twig', array(
                    'post' => $post,
                    'edit_form' => $editForm->createView(),
                    'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a post entity.
     *
     */
    public function deleteAction(Request $request, Post $post) {
        $form = $this->createDeleteForm($post);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($post);
            $em->flush();
        }

        return $this->redirectToRoute('post_index');
    }

    /**
     * Creates a form to delete a post entity.
     *
     * @param Post $post The post entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Post $post) {
        return $this->createFormBuilder()
                        ->setAction($this->generateUrl('post_delete', array('id' => $post->getId())))
                        ->setMethod('DELETE')
                        ->getForm()
        ;
    }

    /**
     * Change the locale for the current user
     *
     * @param String $language
     * @return array
     */
    public function setLocaleAction($language = null) {
        if ($language != null) {
            // On enregistre la langue en session
            $this->get('session')->set('_locale', $language);
        }

        // on tente de rediriger vers la page d'origine
        $url = $this->container->get('request')->headers->get('referer');
        if (empty($url)) {
            $url = $this->container->get('router')->generate('index');
        }

        return new RedirectResponse($url);
    }

}
