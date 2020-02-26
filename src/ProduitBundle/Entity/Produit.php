<?php

namespace ProduitBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Produit
 */
class Produit
{
    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $nom;



    /**
     * @ORM\Column(type="string",length=255,nullable=true)
     */
    public $image;
    /**
     * @Assert\File(maxSize="700K")
     */
    public $file;

    /**
     * @var int
     */
    private $quantite;

    /**
     * @var float
     */
    private $prix;

    /**
     * @ORM\ManyToOne(targetEntity="Categorie")
     * @ORM\JoinColumn(name="categorie_id", referencedColumnName="id")
     */
    private $categorie;


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
     * Set nom
     *
     * @param string $nom
     *
     * @return Produit
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set quantite
     *
     * @param integer $quantite
     *
     * @return Produit
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
     * Set prix
     *
     * @param float $prix
     *
     * @return Produit
     */
    public function setPrix($prix)
    {
        $this->prix = $prix;

        return $this;
    }

    /**
     * Get prix
     *
     * @return float
     */
    public function getPrix()
    {
        return $this->prix;
    }

    /**
     * Set categorie
     *
     * @param \ProduitBundle\Entity\Categorie $categorie
     *
     * @return Produit
     */
    public function setCategorie(\ProduitBundle\Entity\Categorie $categorie = null)
    {
        $this->categorie = $categorie;

        return $this;
    }

    /**
     * Get categorie
     *
     * @return \ProduitBundle\Entity\Categorie
     */
    public function getCategorie()
    {
        return $this->categorie;
    }



    public function getWebPath(){

        return null===$this->image ? null :$this->getUploadDir.'/'.$this->image;
    }
    protected function getUploadRootDir(){

        return dirname(__FILE__) .'/../../../web/'.$this->getUploadDir();
    }
    protected function getUploadDir(){

        return 'images';
    }
    public function uploadProfilePicture(){
        $this->file->move($this->getUploadRootDir(),$this->file->getClientOriginalName());
        $this->image=$this->file->getClientOriginalName();
        $this->file=null;
    }

    /**
     * Set image
     *
     * @param string $image
     *
     * @return Produit
     */
    public function setimage($image){
        $this->image==$image;
        return $this;

    }

    /**
     * Get image
     *
     * @return string
     */
    public function getimage(){

        return $this->image;
    }


}
