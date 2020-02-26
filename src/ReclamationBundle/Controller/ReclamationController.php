<?php

namespace ReclamationBundle\Controller;

use ReclamationBundle\Entity\reclamation;
use Symfony\Component\HttpFoundation\Request;
use ReclamationBundle\Form\reclamationType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class ReclamationController extends Controller
{
    public function readAction()
    {
        //creer un objet doctrine
        $em= $this->getDoctrine();
        $tab=$em->getRepository(reclamation::class)->findAll();

        return $this->render('@Reclamation/Default/readReclamation.html.twig', array('clubs'=>$tab));
    }


    public function createAction(Request $request)
    {
        $cnx= $this->getDoctrine()->getManager();
        $c = new reclamation();

        $form = $this->createForm(reclamationType::class, $c);
        $table = $cnx->getRepository(User::class)->findAll();
        $form->handleRequest($request);

        if ($form->isValid()) {

            echo "aaa";
            echo $c->getDescription();


            /*$id = $request->getUser();
            $user = $cnx->getRepository(User::class)->find($id);*/

            echo $table[0]->getNom();

            $cnx->persist($c);
            $cnx->flush();
            echo "<script>alert('Ajout reclamation effectué')</script>";


            return $this->redirectToRoute('reclamation_read');
        }
        return $this->render('@Reclamation/Default/createReclamation.html.twig', array('form' => $form->createView(), 'table' => $table
            // ...
        ));

    }
    public function deleteAction($id)
    {
        $cnx=$this->getDoctrine()->getManager();
        $d=$cnx->getRepository("ReclamationBundle:reclamation")->find($id);
        $cnx->remove($d);
        $cnx->flush();
        echo "<script>alert('Suppression admin succeed')</script>";
        return $this->redirectToRoute('reclamation_read');


    }

    public function updateAction(Request $request,$id)
    {
        $cnx=$this->getDoctrine()->getManager();
        $modif=$cnx->getRepository("ReclamationBundle:reclamation")->find($id);
        $form=$this->createForm(reclamationType::class,$modif);
        $form->handleRequest($request);
        if($form->isValid())
        {

            $cnx->persist($modif);
            $cnx->flush();
            echo "<script>alert('Modification equipe succeed')</script>";
            return $this->redirectToRoute('reclamation_read');


        }
        return $this->render('@Reclamation/Default/updateReclamation.html.twig', array('form'=>$form->createView()
            // ...
        ));
    }
    public function searchAction(Request $request)
    {
        $input = $request->get('type');
        $em = $this->getDoctrine();
        $tab = $em->getRepository(reclamation::class)->findAll();
        if (isset($input) & !empty($input)) {
            $tab = $this->getDoctrine()->getRepository(reclamation::class)->myfindAll($input);
            return $this->render('@Reclamation/Default/readReclamation.html.twig', array('clubs' => $tab));
        }
        return $this->render('@Reclamation/Default/searchReclamation.html.twig', array('clubs' => $tab));
    }

}
