<?php

namespace ShopBundle\Repository;

/**
 * PanierRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PanierRepository extends \Doctrine\ORM\EntityRepository
{
    public function findProduit($id)
    {
        $query=$this->getEntityManager()->
        createQuery("SELECT p FROM ShopBundle:Panier p where p.produit ='$id'");
        return $query->getResult();
    }

    public function findPanier($id_client)
    {
        $query=$this->getEntityManager()->
        createQuery("SELECT p FROM ShopBundle:Panier p where p.client ='$id_client'");
        return $query->getResult();
    }

}
