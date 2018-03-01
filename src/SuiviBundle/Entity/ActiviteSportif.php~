<?php

namespace SuiviBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * ActiviteSportif
 *
 * @ORM\Table(name="activite_sportif")
 * @ORM\Entity(repositoryClass="SuiviBundle\Repository\ActiviteSportifRepository")
 */
class ActiviteSportif
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
     * @var string
     *
     * @ORM\Column(name="nom", type="string", length=255,nullable= true)
     */
    private $nom;

    /**
     * @var float
     *
     * @ORM\Column(name="met", type="float",nullable= true)
     */
    private $met;


    /**
     * Get id.
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set nom.
     *
     * @param string $nom
     *
     * @return ActiviteSportif
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

        return $this;
    }

    /**
     * Get nom.
     *
     * @return string
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set met.
     *
     * @param float $met
     *
     * @return ActiviteSportif
     */
    public function setMet($met)
    {
        $this->met = $met;

        return $this;
    }

    /**
     * Get met.
     *
     * @return float
     */
    public function getMet()
    {
        return $this->met;
    }
}
