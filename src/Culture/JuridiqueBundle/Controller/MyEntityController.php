<?php

namespace Culture\JuridiqueBundle\Controller;

use Culture\JuridiqueBundle\Entity\MyEntity;
use Culture\JuridiqueBundle\Form\MyEntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

/**
 * MyEntity controller.
 *
 */
class MyEntityController extends Controller {

    public function editTeamAction($id) {
        if (!$id)
            throw $this->createNotFoundException('ID is needed, ' . $id);
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CultureJuridiqueBundle:MyEntity')->find($id);
        if (!$entity)
            throw $this->createNotFoundException('Entity not found with id ' . $id);
        $editForm = $this->createEditForm($entity);

        return $this->render("CultureJuridiqueBundle:myentity:edit.html.twig", array("entity" => $entity, "edit_form" => $editForm->createView(), "path_form" => "ent_update"));
    }

    private function createEditForm(MyEntity $entity) {
        $form = $this->createForm(new MyEntityType(), $entity);
        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }

    public function updateTeamAction(Request $request, $id) {
        $em = $this->getDoctrine()->getEntityManager();
        $entity = $em->getRepository('CultureJuridiqueBundle:MyEntity')->find($id);
        if (!$entity)
            throw $this->createNotFoundException('Entity not found with id ' . $id);

        $editForm = $this->createEditForm($entity);
        //Save original Logo
        $logoOriginal = $entity->getLogo();
        $editForm->handleRequest($request);
        if ($editForm->isValid()) {
            $files = $request->files;
            $uploadedFile = $files->get('logo')['file'];
            if (count($uploadedFile) == 0)
                $entity->setLogo($logoOriginal);
            else {
                $documents = new Documents();
                $documents->setPath('logo');
                $documents->setFile($uploadedFile);

                $entity->setLogo($documents);
                if (!empty($logoOriginal)) {
                    $fs = new Filesystem();
                    $fs->remove($documents->getAbsolutePath() . '/' . $logoOriginal->getName());
                }
            }
            $em->persist($entity);
            $em->flush();
            $this->get('session')->getFlashBag()->add(
                    'notice', 'Edit success.'
            );
            return $this->redirect($this->generateUrl('ent_edit', array( 'id' => $id)));
        }
        return $this->render("CultureJuridiqueBundle:myentity:edit.html.twig", array("entity" => $entity, "edit_form" => $editForm->createView(), "path_form" => "ent_update"));
    }

}
