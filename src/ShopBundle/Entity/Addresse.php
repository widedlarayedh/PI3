<?php

namespace ShopBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Addresse
 *
 * @ORM\Table(name="addresse")
 * @ORM\Entity(repositoryClass="ShopBundle\Repository\AddresseRepository")
 */
class Addresse
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
     * @ORM\Column(name="numTel", type="integer")
     */
    private $numTel;

    /**
     * @var string
     *
     * @ORM\Column(name="mail", type="string", length=255)
     */
    private $mail;

    /**
     * @var string
     *
     * @ORM\Column(name="pays", type="string", length=255)
     */
    private $pays;

    /**
     * @var string
     *
     * @ORM\Column(name="ville", type="string", length=255)
     */
    private $ville;

    /**
     * @var int
     *
     * @ORM\Column(name="pinCode", type="integer")
     */
    private $pinCode;


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
     * Set numTel
     *
     * @param integer $numTel
     *
     * @return Addresse
     */
    public function setNumTel($numTel)
    {
        $this->numTel = $numTel;

        return $this;
    }

    /**
     * Get numTel
     *
     * @return int
     */
    public function getNumTel()
    {
        return $this->numTel;
    }

    /**
     * Set mail
     *
     * @param string $mail
     *
     * @return Addresse
     */
    public function setMail($mail)
    {
        $this->mail = $mail;

        return $this;
    }

    /**
     * Get mail
     *
     * @return string
     */
    public function getMail()
    {
        return $this->mail;
    }

    /**
     * Set pays
     *
     * @param string $pays
     *
     * @return Addresse
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville
     *
     * @param string $ville
     *
     * @return Addresse
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set pinCode
     *
     * @param integer $pinCode
     *
     * @return Addresse
     */
    public function setPinCode($pinCode)
    {
        $this->pinCode = $pinCode;

        return $this;
    }

    /**
     * Get pinCode
     *
     * @return int
     */
    public function getPinCode()
    {
        return $this->pinCode;
    }
}
