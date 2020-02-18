<?php

namespace ShopBundle\Controller;

use ShopBundle\Entity\Produit;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class ProduitController extends Controller
{
    public function readAction()
    {
        $em=$this->getDoctrine();
        $liste=$em->getRepository(Produit::class)->findAll();
        return $this->render('@Shop/Produit/read.html.twig', array(
            "liste"=>$liste
        ));
    }

}
