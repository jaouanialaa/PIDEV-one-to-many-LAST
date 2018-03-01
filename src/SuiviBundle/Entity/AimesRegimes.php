<?php

namespace SuiviBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * AimesRegimes
 *
 * @ORM\Table(name="aimes_regimes")
 * @ORM\Entity(repositoryClass="SuiviBundle\Repository\AimesRegimesRepository")
 */
class AimesRegimes
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
     * @var \DateTime
     *
     * @ORM\Column(name="date", type="date")
     */
    private $date;

    public function __construct()
    {
        $this->setDate(new \DateTime());

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
     * Set user.
     *
     * @param string $user
     *
     * @return AimesRegimes
     */
    public function setUser($user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user.
     *
     * @return string
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set regime.
     *
     * @param string $regime
     *
     * @return AimesRegimes
     */
    public function setRegime($regime)
    {
        $this->regime = $regime;

        return $this;
    }

    /**
     * Get regime.
     *
     * @return string
     */
    public function getRegime()
    {
        return $this->regime;
    }

    /**
     * Set date.
     *
     * @param string $date
     *
     * @return AimesRegimes
     */
    public function setDate($date)
    {
        $this->date = $date;

        return $this;
    }

    /**
     * Get date.
     *
     * @return string
     */
    public function getDate()
    {
        return $this->date;
    }
}
