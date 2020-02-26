<?php

namespace ShopBundle\Repository;

/**
 * CommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CommandeRepository extends \Doctrine\ORM\EntityRepository
{

    public function findCommande($id_client)
    {
        $query=$this->getEntityManager()->
        createQuery("SELECT p FROM ShopBundle:Commande p where p.client ='$id_client'");
        return $query->getResult();
    }

    public function rechercheDynamique($mot){
        $query=$this->getEntityManager()->createQuery("select c.id,c.prixtotal,u.username,c.etat from  
ShopBundle\Entity\Commande c left join UserBundle\Entity\User u with c.client=u.id where c.id like :key or c.prixtotal
 like :key or c.etat like :key or u.username like :key")->setParameter("key","%".$mot."%");
        return $query->getResult();
    }

}
