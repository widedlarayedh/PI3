<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;
use UserBundle\Form\UserType;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('@User/Default/index.html.twig');
    }

    public function redirectAction(){
        $authChecker=$this->container->get("security.authorization_checker");
        if ($authChecker->isGranted("ROLE_CLIENT"))
        {
            //return $this->render("@Shop/Produit/read.html.twig");
            return $this->redirectToRoute("readProduit");
        }else if($authChecker->isGranted("ROLE_AGENT")){
            return $this->redirectToRoute("readAdmin");
        }
        else {
            return $this->render("@FOSUser/Security/login.html.twig");
        }
    }

        public function readAction(Request $request)
        {
            //creer un objet doctrine
            $em= $this->getDoctrine();
            $tab=$em->getRepository(User::class)->findAll();
            /**
             * @var $paginator \Knp\Component\Pager\Paginator

             */
            $paginator=$this->get('knp_paginator');
            $result = $paginator->paginate(
                $tab,
                $request->query->getInt('page', 1),
                $request->query->getInt('limit', 2)
            );



            return $this->render('@User/Default/user.html.twig', array('users'=>$result));
        }



        public function createAction(Request $request)
        {

            $u=new User();

            $form=$this->createForm(UserType::class,$u);
            $form->handleRequest($request);
            if($form->isValid())
            {
                $u->uploadProfilePicture();

                $u->SetRoles(array("ROLE_AGENT, ROLE_USER"));
                $u->SetUsername($u->getNom());
                $cnx=$this->getDoctrine()->getManager();
                $cnx->persist($u);
                $cnx->flush();
                echo "<script>alert('Ajout club effectué')</script>";
                return $this->redirectToRoute('read');
            }
            return $this->render('@User/Default/create.html.twig', array('form'=>$form->createView()
                // ...
            ));
        }

        public function updateAction(Request $request,$id)
        {
            $cnx=$this->getDoctrine()->getManager();
            $modif=$cnx->getRepository("UserBundle:User")->find($id);
            $form=$this->createForm(UserType::class,$modif);
            $form->handleRequest($request);
            if($form->isValid())
            {
                $modif->uploadProfilePicture();
                $cnx->persist($modif);
                $cnx->flush();
                echo "<script>alert('Modification equipe succeed')</script>";
                return $this->redirectToRoute('read_user');


            }
            return $this->render('@User/Default/create.html.twig', array('form'=>$form->createView()
                // ...
            ));
        }

        public function deleteAction($id)
        {
            $cnx=$this->getDoctrine()->getManager();
            $d=$cnx->getRepository("UserBundle:user")->find($id);
            $cnx->remove($d);
            $cnx->flush();
            echo "<script>alert('Suppression admin succeed')</script>";
            return $this->redirectToRoute('read_user');


        }
        public function readclientAction()
        {
            //creer un objet doctrine
            $em= $this->getDoctrine();
            $tab=$em->getRepository(User::class)->findAll();
            return $this->render('@User/client/user.html.twig', array('users'=>$tab));
        }


        public function bloquageAction($id)
        {
            $cnx=$this->getDoctrine()->getManager();
            $bloc=$cnx->getRepository("UserBundle:User")->find($id);
            $bloc->setEnabled(0);
            $cnx->flush();
            return $this->redirectToRoute('read_user');
        }



}
