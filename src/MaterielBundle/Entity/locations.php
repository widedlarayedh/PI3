<?php

namespace MaterielBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * locations
 *
 * @ORM\Table(name="locations")
 * @ORM\Entity(repositoryClass="MaterielBundle\Repository\locationsRepository")
 */
class locations
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
     * @ORM\ManyToOne(targetEntity="materielle")
     * @ORM\JoinColumn(name="materiel",referencedColumnName="id")
     */
    private $materiel;


    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateDebut", type="date")
     */
    private $dateDebut;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date")
     */
    private $datefin;


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
     * Set dateDebut
     *
     * @param \DateTime $dateDebut
     *
     * @return locations
     */
    public function setDateDebut($dateDebut)
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    /**
     * Get dateDebut
     *
     * @return \DateTime
     */
    public function getDateDebut()
    {
        return $this->dateDebut;
    }

    /**
     * Set datefin
     *
     * @param \DateTime $datefin
     *
     * @return locations
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set materiel
     *
     * @param \MaterielBundle\Entity\materielle $materiel
     *
     * @return locations
     */
    public function setMateriel(\MaterielBundle\Entity\materielle $materiel = null)
    {
        $this->materiel = $materiel;

        return $this;
    }

    /**
     * Get materiel
     *
     * @return \MaterielBundle\Entity\materielle
     */
    public function getMateriel()
    {
        return $this->materiel;
    }
}
