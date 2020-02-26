<?php

namespace MaterielBundle\Controller;


use MaterielBundle\Entity\locations;
use MaterielBundle\Entity\materielle;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class locationsController extends Controller
{
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $locations = $em->getRepository('MaterielBundle:locations')->findAll();

        return $this->render('location/index.html.twig', array(
            'locations' => $locations,
        ));
    }

    /**
     * Creates a new location entity.
     *
     */
    public function newAction(Request $request)
    { $em = $this->getDoctrine()->getManager();
        $location = new locations();
        $form = $this->createForm('MaterielBundle\Form\locationsType', $location);
        $table=$em->getRepository(materielle::class)->findAll();
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $x = $location->getDateDebut();
            $y = $location->getDatefin();

            $date1 = strtotime( $x->format("Y-m-d") );
            $date2 = strtotime( $y->format("Y-m-d"));




            $diff = $date2 - $date1;
            if($diff >0) {



                $id = $request->get('materiel');
                $materiel = $em->getRepository(materielle::class)->find($id);
                $location->setMateriel($materiel);
                $em = $this->getDoctrine()->getManager();
                $em->persist($location);
                $em->flush();
//$test = $materiel;

                $message = (new \Swift_Message('Hello Email'))
                    ->setFrom('moetez.mahouachi@esprit.tn')
                    ->setTo('elmahouachitaz@gmail.com')
                    ->setBody("Your location has been added");

                $this->get('mailer')->send($message);
                return $this->redirectToRoute('location_show', array('id' => $location->getId()));
            }
            else{
                echo'<script> alert("verif la datte")</script>';
                return $this->render('location/new.html.twig', array(
                    'location' => $location,
                    'form' => $form->createView(),'table'=>$table
                ));
            }
        }

        return $this->render('location/new.html.twig', array(
            'location' => $location,
            'form' => $form->createView(),'table'=>$table
        ));
    }

    /**
     * Finds and displays a location entity.
     *
     */
    public function showAction(locations $location)
    {
        $deleteForm = $this->createDeleteForm($location);

        return $this->render('location/show.html.twig', array(
            'location' => $location,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing location entity.
     *
     */
    public function editAction(Request $request, locations $location)
    {
        $deleteForm = $this->createDeleteForm($location);
        $editForm = $this->createForm('MaterielBundle\Form\locationsType', $location);
        $editForm->handleRequest($request);
        $em = $this->getDoctrine()->getManager();
        $table=$em->getRepository(materielle::class)->findAll();
        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $id=$request->get('materiel');
            $materiel=$em->getRepository(materielle::class)->find($id);
            $location->setMateriel($materiel);

            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('location_edit', array('id' => $location->getId()));
        }

        return $this->render('location/edit.html.twig', array(
            'location' => $location,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),'table'=>$table
        ));
    }

    /**
     * Deletes a location entity.
     *
     */
    public function deleteAction(Request $request, locations $location)
    {
        $form = $this->createDeleteForm($location);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($location);
            $em->flush();
        }

        return $this->redirectToRoute('location_index');
    }

    /**
     * Creates a form to delete a location entity.
     *
     * @param locations $location The location entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(locations $location)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('location_delete', array('id' => $location->getId())))
            ->setMethod('DELETE')
            ->getForm()
            ;
    }
}
