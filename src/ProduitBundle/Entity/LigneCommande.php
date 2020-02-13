<?php

namespace ProduitBundle\Entity;

/**
 * LigneCommande
 */
class LigneCommande
{

    /**
     * @var int
     */
    private $id;

    /**
     * @var int
     */
    private $quantite;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return LigneCommande
     */
    public function setQuantite($quantite)
    {
        $this->quantite = $quantite;

        return $this;
    }

    /**
     * Get quantite
     *
     * @return int
     */
    public function getQuantite()
    {
        return $this->quantite;
    }


    /**
     * @ORM\ManyToOne(targetEntity="Produit")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id")
     */
    private $produit;


    /**
     * Set produit
     *
     * @param \ProduitBundle\Entity\Produit $produit
     *
     * @return LigneCommande
     */
    public function setProduit(\ProduitBundle\Entity\Produit $produit = null)
    {
        $this->produit = $produit;

        return $this;
    }

    /**
     * Get produit
     *
     * @return \ProduitBundle\Entity\Produit
     */
    public function getProduit()
    {
        return $this->produit;
    }



    /**
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumn(name="commande_id", referencedColumnName="id")
     */
    private $commande;


    /**
     * Set commande
     *
     * @param \ProduitBundle\Entity\Commande $commande
     *
     * @return LigneCommande
     */
    public function setCommande(\ProduitBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \ProduitBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }



}

