<?php

namespace UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

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
        }else if($authChecker->isGranted("ROLE_RESPONSABLE")){
            return $this->redirectToRoute("readAdmin");
        }
        else {
            return $this->render("@FOSUser/Security/login.html.twig");
        }

    }
}
