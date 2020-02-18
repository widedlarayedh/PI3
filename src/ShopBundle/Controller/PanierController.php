<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Client;
use ShopBundle\Entity\Panier;
use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PanierController extends Controller
{
    public function createAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $paniertest=$em->getRepository(Panier::class)->findProduit($id);
        if(count($paniertest)==0)
        {
            $panier= new Panier();
            $client = new Client();

            $produit=$em->getRepository(Produit::class)->find($id);
            $client=$em->getRepository(Client::class)->find(22);
            $panier->setProduit($produit);
            $panier->setClient($client);
            $panier->setQuantite(1);
            $em->persist($panier);
            $em->flush();

        }
        else
        {
            $panier2=$paniertest[0];
            $panier2->setQuantite($panier2->getQuantite()+1);
            $em->persist($panier2);
            $em->flush();
        }



        return $this->redirectToRoute('readProduit');
    }

    public function readAction($id_client)
    {
        $em=$this->getDoctrine()->getManager();
        $paniers=$em->getRepository(Panier::class)->findPanier($id_client);
        return $this->render('@Shop/Panier/read.html.twig', array(
            "liste"=>$paniers
        ));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $panier=$em->getRepository(Panier::class)->find($id);
        $em->remove($panier);
        $em->flush();
        return $this->redirectToRoute('readPanier',array("id_client"=>22));
    }

    public function updateAction($id,$mod)
    {
        $em=$this->getDoctrine()->getManager();
        $panier=$em->getRepository(Panier::class)->find($id);
        if($mod==1)
        {
            $panier->setQuantite($panier->getQuantite()+1);
        }
        if($mod==0)
        {
            $panier->setQuantite($panier->getQuantite()-1);
        }
        if($panier->getQuantite()==0)
        {
            $em->remove($panier);
        }
        else{
            $em->persist($panier);
        }

        $em->flush();
        return $this->redirectToRoute('readPanier',array("id_client"=>22));
    }

}
