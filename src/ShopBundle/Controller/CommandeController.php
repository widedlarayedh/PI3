<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Client;
use ShopBundle\Entity\Addresse;
use ShopBundle\Entity\Commande;
use ShopBundle\Entity\Panier;
use ShopBundle\Entity\PanierVendu;
use ProduitBundle\Entity\Produit;
use ShopBundle\Form\AddresseType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Symfony\Component\HttpFoundation\Request;
use UserBundle\Entity\User;

class CommandeController extends Controller
{
    public function createAction(Request $request,$idAddresse)
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
        $adresse=$em->getRepository(Addresse::class )->find($idAddresse);
        $commande->setAddresse($adresse);
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

    public function createAdresseAction(Request $request){
        $adresse=new Addresse();
        $form=$this->createForm(AddresseType::class,$adresse);
        $form=$form->handleRequest($request);
        if($form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($adresse);
            $em->flush();
            return $this->redirectToRoute("createCommande",array("idAddresse"=>$adresse->getId()));
        }
        return $this->render("@Shop/Adresse/adresse.html.twig",array("form"=>$form->createView()));
    }

}
