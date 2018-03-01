<?php

namespace SuiviBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * LigneRegime
 *
 * @ORM\Table(name="ligne_regime")
 * @ORM\Entity(repositoryClass="SuiviBundle\Repository\LigneRegimeRepository")
 */
class LigneRegime
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
     *
     * @ORM\ManyToOne(targetEntity="GUBundle\Entity\Utilisateur")
     *
     * @ORM\JoinColumn(name="utilisateur",referencedColumnName="id")
     *
     */
    private $user;
    /**
     *
     * @ORM\ManyToOne(targetEntity="SuiviBundle\Entity\Regime")
     *
     * @ORM\JoinColumn(name="regime",referencedColumnName="id")
     *
     */
    private $regime;

    /**
     * @var string
     *
     * @ORM\Column(name="etat", type="string", length=255)
     */
    private $etat;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datedeb", type="date")
     */
    private $datedeb;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="datefin", type="date")
     */
    private $datefin;

    public function __construct()
    {
        $this->setDatedeb(new \DateTime());
    }

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
     * Set etat.
     *
     * @param string $etat
     *
     * @return LigneRegime
     */
    public function setEtat($etat)
    {
        $this->etat = $etat;

        return $this;
    }

    /**
     * Get etat.
     *
     * @return string
     */
    public function getEtat()
    {
        return $this->etat;
    }

    /**
     * Set datedeb.
     *
     * @param \DateTime $datedeb
     *
     * @return LigneRegime
     */
    public function setDatedeb($datedeb)
    {
        $this->datedeb = $datedeb;

        return $this;
    }

    /**
     * Get datedeb.
     *
     * @return \DateTime
     */
    public function getDatedeb()
    {
        return $this->datedeb;
    }

    /**
     * Set datefin.
     *
     * @param \DateTime $datefin
     *
     * @return LigneRegime
     */
    public function setDatefin($datefin)
    {
        $this->datefin = $datefin;

        return $this;
    }

    /**
     * Get datefin.
     *
     * @return \DateTime
     */
    public function getDatefin()
    {
        return $this->datefin;
    }

    /**
     * Set user.
     *
     * @param \GUBundle\Entity\Utilisateur|null $user
     *
     * @return LigneRegime
     */
    public function setUser(\GUBundle\Entity\Utilisateur $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return \GUBundle\Entity\Utilisateur|null
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set regime.
     *
     * @param \SuiviBundle\Entity\Regime|null $regime
     *
     * @return LigneRegime
     */
    public function setRegime(\SuiviBundle\Entity\Regime $regime = null)
    {
        $this->regime = $regime;

        return $this;
    }

    /**
     * Get regime.
     *
     * @return \SuiviBundle\Entity\Regime|null
     */
    public function getRegime()
    {
        return $this->regime;
    }
}
