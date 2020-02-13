<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\Categorie;
use ProduitBundle\Entity\Produit;
use ProduitBundle\Form\CategorieType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CategorieController extends Controller
{

    public function readAction()
    {
        $em=$this->getDoctrine();
        $tab=$em->getRepository(Categorie::class)->findAll();
        return $this->render('@Produit/Categorie/read.html.twig', array(
            'categories'=>$tab
        ));
    }

    public function readOneAction($id)
    {
        $em=$this->getDoctrine();
        $cat=$em->getRepository(Categorie::class)->find($id);
        $products = $em->getRepository(Produit::class)->findBy(['categorie'=> $cat]);
        return $this->render('@Produit/Categorie/show.html.twig', ['categorie' => $cat, 'products'=> $products]);
    }


    public function createAction(Request $request)
    {
        $club=new Categorie();
        $form=$this->createForm(CategorieType::class, $club);
        $form=$form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($club);
            $em->flush();
            return $this->redirectToRoute('read');
        }

        return $this->render('@Produit/Categorie/create.html.twig', array(
            'form'=>$form->createView()
        ));

    }


    public function updateAction($id, Request $request)
    {

        $em=$this->getDoctrine()->getManager();
        $club=$em->getRepository(Categorie::class)->find($id);
        $form=$this->createForm(CategorieType::class, $club);
        $form=$form->handleRequest($request);
        if($form->isValid()){
            $em->flush();
            return $this->redirectToRoute('read');
        }

        return $this->render('@Produit/Categorie/create.html.twig', array(
            'form'=>$form->createView()
        ));
    }



    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $club=$em->getRepository(Categorie::class)->find($id);

        $em->remove($club);
        $em->flush();

        return $this->redirectToRoute('read');

    }

}
