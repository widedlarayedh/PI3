<?php

namespace ShopAdminBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ShopAdminBundle:Default:index.html.twig');
    }
}
