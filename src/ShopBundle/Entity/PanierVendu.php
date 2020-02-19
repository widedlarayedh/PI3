<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
/**
 * PanierVendu
 *
 * @ORM\Table(name="panier_vendu")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\PanierVenduRepository")
 */
class PanierVendu
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var int
     *
     * @ORM\Column(name="quantite", type="integer")
     */
    private $quantite;

    /**
     * @ORM\ManyToOne(targetEntity="\ProduitBundle\Entity\Produit")
     * @ORM\JoinColumn(name="produit_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $produit;

    /**
     * @ORM\ManyToOne(targetEntity="Client")
     * @ORM\JoinColumn(name="client_id", referencedColumnName="id")
     */
    private $client;

    /**
     * @ORM\ManyToOne(targetEntity="Commande")
     * @ORM\JoinColumn(name="commande_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $commande;


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
     * @return PanierVendu
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
     * Set client
     *
     * @param \ShopBundle\Entity\Client $client
     *
     * @return PanierVendu
     */
    public function setClient(\ShopBundle\Entity\Client $client = null)
    {
        $this->client = $client;

        return $this;
    }

    /**
     * Get client
     *
     * @return \ShopBundle\Entity\Client
     */
    public function getClient()
    {
        return $this->client;
    }

    /**
     * Set commande
     *
     * @param \ShopBundle\Entity\Commande $commande
     *
     * @return PanierVendu
     */
    public function setCommande(\ShopBundle\Entity\Commande $commande = null)
    {
        $this->commande = $commande;

        return $this;
    }

    /**
     * Get commande
     *
     * @return \ShopBundle\Entity\Commande
     */
    public function getCommande()
    {
        return $this->commande;
    }

    /**
     * Set produit
     *
     * @param \ProduitBundle\Entity\Produit $produit
     *
     * @return PanierVendu
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
}
