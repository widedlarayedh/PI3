<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\reponse;
use ReclamationBundle\Form\reponseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ReponseController extends Controller
{
    public function readAction()
    {
        //creer un objet doctrine
        $em= $this->getDoctrine();
        $tab=$em->getRepository(reponse::class)->findAll();
        return $this->render('@Reclamation/reponsetwig/readReponse.html.twig', array('reponses'=>$tab));
    }


    public function createAction(Request $request)
    {
        $r=new reponse();
        $form=$this->createForm(reponseType::class,$r);
        $form->handleRequest($request);
        if($form->isValid())
        {

            $em=$this->getDoctrine()->getManager();
            $em->persist($r);

            $em->flush();
            echo "<script>alert('Ajout réponse effectué')</script>";
            /*-$basic  = new \Nexmo\Client\Credentials\Basic('7e75d0ad', 'Nqb1izzdjQmGM8PP');
            $client =new \Nexmo\Client($basic);



             $message = $client->message()->send([
                  'to' => '21692194316',
                  'from' => 'Salah',
                  'text' => 'Votre réclamation est traitée '
              ]);*/
            return $this->redirectToRoute('reponse_read');
        }
        return $this->render('@Reclamation/reponsetwig/createReponse.html.twig', array('form'=>$form->createView()));
    }

    public function deleteAction($id)
    {
        $cnx=$this->getDoctrine()->getManager();
        $d=$cnx->getRepository("ReclamationBundle:reponse")->find($id);
        $cnx->remove($d);
        $cnx->flush();
        echo "<script>alert('Suppression admin succeed')</script>";
        return $this->redirectToRoute('reponse_read');


    }

    public function updateAction(Request $request,$id)
    {
        $cnx=$this->getDoctrine()->getManager();
        $modif=$cnx->getRepository("ReclamationBundle:reponse")->find($id);
        $form=$this->createForm(reponseType::class,$modif);
        $form->handleRequest($request);
        if($form->isValid())
        {

            $cnx->persist($modif);
            $cnx->flush();
            echo "<script>alert('Modification reponse du reclamation succeed')</script>";
            return $this->redirectToRoute('reponse_read');


        }
        return $this->render('@Reclamation/reponsetwig/update.html.twig', array('form'=>$form->createView()
            // ...
        ));
    }



}
