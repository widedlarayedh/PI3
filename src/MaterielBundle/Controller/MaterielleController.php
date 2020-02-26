<?php

namespace MaterielBundle\Controller;

use MaterielBundle\Entity\materielle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MaterielleController extends Controller
{
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $materiels = $em->getRepository('MaterielBundle:materielle')->findAll();
        /*
                $paginator  = $this->get('knp_paginator');
                $pagination = $paginator->paginate(
                    $materiels,
                    $request->query->getInt('page', 1),
                    3
                );
                */
        return $this->render('materiel/index.html.twig', array(
            'materiels' => $materiels,
// 'pagination' => $pagination
        ));
    }

    /**
     * Creates a new materiel entity.
     *
     */
    public function newAction(Request $request)
    {
        $materiel = new materielle();
        $photoM=$request->get('photoM');
        $form = $this->createForm('MaterielBundle\Form\materielleType', $materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $materiel->setImage($photoM);
            $em = $this->getDoctrine()->getManager();
            $em->persist($materiel);
            $em->flush();

            return $this->redirectToRoute('materiel_show', array('id' => $materiel->getId()));
        }

        return $this->render('materiel/new.html.twig', array(
            'materiel' => $materiel,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a materiel entity.
     *
     */
    public function showAction(materielle $materiel)
    {
        $deleteForm = $this->createDeleteForm($materiel);


        return $this->render('materiel/show.html.twig', array(
            'materiel' => $materiel,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing materiel entity.
     *
     */
    public function editAction(Request $request, materielle $materiel)
    {
        $deleteForm = $this->createDeleteForm($materiel);
        $editForm = $this->createForm('MaterielBundle\Form\materielleType', $materiel);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('materiel_edit', array('id' => $materiel->getId()));
        }

        return $this->render('materiel/edit.html.twig', array(
            'materiel' => $materiel,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a materiel entity.
     *
     */
    public function deleteAction(Request $request, materielle $materiel)
    {
        $form = $this->createDeleteForm($materiel);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($materiel);
            $em->flush();
        }

        return $this->redirectToRoute('materiel_index');
    }

    /**
     * Creates a form to delete a materiel entity.
     *
     * @param materielle $materiel The materiel entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(materielle $materiel)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('materiel_delete', array('id' => $materiel->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }

    public function searchAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $requestString = $request->get('q');
        $materiels=  $em->getRepository('MaterielBundle:Materiel')->findEntitiesByString($requestString);
        if(!$materiels) {
            $result['materiels']['error'] = "Post Not found :( ";
        } else {
            $result['materiels'] = $this->getRealEntities($materiels);
        }
        return new Response(json_encode($result));
    }
    public function getRealEntities($materiels){
        foreach ($materiels as $materiels){
            $realEntities[$materiels->getId()] = [$materiels->getImage(),$materiels->getNom()];

        }
        return $realEntities;
    }
}
