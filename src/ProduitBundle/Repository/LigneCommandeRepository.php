<?php

namespace ProduitBundle\Repository;

/**
 * LigneCommandeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class LigneCommandeRepository extends \Doctrine\ORM\EntityRepository
{


    public function myFindAllByCommandeId($input){
        $query=$this->getEntityManager()
            ->createQuery("SELECT c FROM ProduitBundle:LigneCommande c WHERE c.id='$input' ");
        return $query->getResult();
    }


}
