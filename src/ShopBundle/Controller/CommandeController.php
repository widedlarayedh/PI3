<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Client;
use ShopBundle\Entity\Commande;
use ShopBundle\Entity\Panier;
use ShopBundle\Entity\PanierVendu;
use ProduitBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use UserBundle\Entity\User;

class CommandeController extends Controller
{
    public function createAction()
    {
        $em=$this->getDoctrine()->getManager();

        //recuperer les articles du panier de ce client
        $paniers=$em->getRepository(Panier::class)->findPanier($this->getUser()->getId());
        $prixtotal=0;
        foreach($paniers as $row)
        {
            $prixtotal+=$row->getProduit()->getPrix()*$row->getQuantite();
            //qte denc
            $produit = $em->getRepository(Produit::class)->find($row->getProduit());
            $produit->setQuantite($produit->getQuantite()-$row->getQuantite());
            $em->flush($produit);
        }

        //$client=$em->getRepository(User::class)->find($id_client);
        $commande= new Commande();
        $commande->setClient($this->getUser());
        $commande->setPrixtotal($prixtotal);
        $commande->setEtat('en cours');

        $em->persist($commande);





        $unpanierVendu= new PanierVendu();

        $i=0;
        foreach ($paniers as $row)
        {
            var_dump($i);
            $unpanierVendu->setClient($this->getUser());
            $unpanierVendu->setQuantite($row->getQuantite());
            $unpanierVendu->setProduit($row->getProduit());
            $unpanierVendu->setCommande($commande);
            $em->persist($unpanierVendu);

            $i+=1;

        }
        $em->flush();

        #vider le
        foreach ($paniers as $row)
        {
            $em->remove($row);

            $em->flush();
        }


        return $this->redirectToRoute('readCommande',array("id_client"=>$this->getUser()->getId()));
    }

    public function readAction()
    {
        $em=$this->getDoctrine();
        $liste=$em->getRepository(Commande::class)->findCommande($this->getUser()->getId());

        return $this->render('@Shop/Commande/read.html.twig', array(
            "liste"=>$liste
        ));
    }

    public function deleteAction($id)
    {
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository(Commande::class)->find($id);
        $em->remove($commande);
        $em->flush();
        return $this->redirectToRoute('readCommande',array("id_client"=>$this->getUser()->getId()));

    }

}
