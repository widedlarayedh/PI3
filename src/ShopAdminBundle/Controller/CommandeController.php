<?php

namespace ShopAdminBundle\Controller;

use ShopBundle\Entity\Client;
use ShopBundle\Entity\Commande;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use UserBundle\Entity\User;

class CommandeController extends Controller
{
    public function readAction()
    {
        $client = $this->getDoctrine()->getRepository(User::class)->findAll();
        $commande = $this->getDoctrine()->getRepository(Commande::class)->findAll();
        return $this->render('@ShopAdmin/Commande/read.html.twig', array(
            'clients'=>$client,'commandes'=>$commande
        ));
    }

    public function deleteAction($id){
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository(Commande::class)->find($id);
        $em->remove($commande);
        $em->flush();

        return $this->redirectToRoute('readAdmin');
    }

    public function traiterAction($id){
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository(Commande::class)->find($id);
        $commande->setEtat('pris en charge');
        $em->flush();

        return $this->redirectToRoute('readAdmin');
    }

    public function imprimerFactureAction($id){
        $em=$this->getDoctrine()->getManager();
        $commande=$em->getRepository(Commande::class)->find($id);
        $client=$em->getRepository(User::class)->find($commande->getClient());
        $snappy = $this->get('knp_snappy.pdf');

        $html = $this->renderView('@ShopAdmin/Commande/facture.html.twig', array(
            //..Send some data to your view if you need to //
            'commande' => $commande, 'client'=>$client

        ));

        $filename = 'myFirstSnappyPDF';

        return new Response(
            $snappy->getOutputFromHtml($html),
            200,
            array(
                'Content-Type'          => 'application/pdf',
                'Content-Disposition'   => 'inline; filename="'.$filename.'.pdf"'
            )
        );
    }

    public function chercherAction(Request $request){
        $input=$request->get('Client');
        //var_dump($input);
        $client=$this->getDoctrine()->getManager()->getRepository(User::class)->find($input);
        //dump($client);
        $em=$this->getDoctrine();
        $commande=$em->getRepository(Commande::class)->findCommande($client->getId());
        //dump($commande);die;
        return $this->render('@ShopAdmin/Commande/readRecherche.html.twig', array(
            'unClient'=>$client,'uneCommande'=>$commande
        ));
    }

}
