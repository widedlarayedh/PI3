<?php

namespace ProduitBundle\Controller;

use ProduitBundle\Entity\LigneCommande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class LigneCommandeController extends Controller
{

    public function readAction()
    {
        $em=$this->getDoctrine();
        $tab=$em->getRepository(LigneCommande::class)->findAll();
        return $this->render('@Produit/Default/read.html.twig', array(
            'lignecommandes'=>$tab
        ));
    }






}
