<?php

namespace GUBundle\Entity;
use FOS\MessageBundle\Model\ParticipantInterface;
use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Collection;


/**
 * @ORM\Entity(repositoryClass="GUBundle\Repository\UtilisateurRepository")
 * @ORM\Table(name="Utilisateur")
 *
 */
class Utilisateur extends BaseUser implements ParticipantInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;


    /**
     * @ORM\Column(type="string", length=255 ,nullable= true)
     */
    protected $nom;
    /**
     * @ORM\Column(type="string", length=255, nullable= true)
     *
     * @Assert\NotBlank(message="voulez vous saisir votre prénom", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Votre prénom est trés court.",
     *     maxMessage="Votre prénom est trés long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $prenom;

    /**
     * @ORM\Column(type="integer", length=15 ,nullable= true)
     *
     * @Assert\NotBlank(message="voulez vous saisir votre prénom", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=15,
     *     minMessage="Votre prénom est trés court.",
     *     maxMessage="Votre prénom est trés long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $telephone;

    /**
     * @ORM\Column(type="string", length=255 , nullable= true)
     *
     * @Assert\NotBlank(message="voulez vous saisir votre prénom", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Votre prénom est trés court.",
     *     maxMessage="Votre prénom est trés long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $address;

    /**
     * @ORM\Column(type="integer", length=4 ,nullable= true)
     *
     * @Assert\NotBlank(message="voulez vous saisir votre prénom", groups={"Registration", "Profile"})
     * @Assert\Length(
     *     min=4,
     *     max=4,
     *     minMessage="Votre prénom est trés court.",
     *     maxMessage="Votre prénom est trés long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $codePostal;

    /**
     * @ORM\Column(type="string", length=25 , nullable= true)
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="voulez vous saisir votre pays", groups={"Registration", "Profile"})
     */
    protected $pays;

    /**
     * @ORM\Column(type="string", length=255 , nullable= true)
     *
     * @Assert\NotBlank(message="voulez vous saisir votre region", groups={"Registration", "Profile"})
     */
    protected $region;

    /**
     * @ORM\Column(type="string", length=255)
     *
     * @Assert\NotBlank(message="voulez vous saisir votre ville", groups={"Registration", "Profile"})
     */
    protected $ville;

    /**
     * @ORM\Column(type="integer", length=15 ,nullable= true)
     * @ORM\Column(type="integer", length=15,nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=15,
     *     minMessage="Votre prénom est trés court.",
     *     maxMessage="Votre prénom est trés long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $fax;

    /**
     * @var string|null
     * @Assert\File(
     *      maxSize="5242880",
     *      mimeTypes = {
     *          "image/png",
     *          "image/jpeg",
     *          "image/jpg",
     *          "image/gif"
     *      }
     * )
     * @ORM\Column(name="img", type="string", length=255, nullable=true)
     */
    protected $img;

    /**
     * @ORM\Column(type="string", length=255,nullable=true)
     *
     * @Assert\Length(
     *     min=3,
     *     max=255,
     *     minMessage="Votre prénom est trés court.",
     *     maxMessage="Votre prénom est trés long.",
     *     groups={"Registration", "Profile"}
     * )
     */
    protected $cv;

    /**
     * @ORM\ManyToOne(targetEntity="SuiviBundle\Entity\Regime")
     *
     * @ORM\JoinColumn(name="idRegime",referencedColumnName="id",nullable= true)
     */
    private $regime;





    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Set nom
     *
     * @param mixed $nom
     */
    public function setNom($nom)
    {
        $this->nom = $nom;

    }

    /**
     * Get nom
     *
     * @return mixed
     */
    public function getNom()
    {
        return $this->nom;
    }

    /**
     * Set prenom
     *
     * @param string $prenom
     *
     * @return Utilisateur
     */
    public function setPrenom($prenom)
    {
        $this->prenom = $prenom;

        return $this;
    }

    /**
     * Get prenom
     *
     * @return string
     */
    public function getPrenom()
    {
        return $this->prenom;
    }

    /**
     * Set telephone
     *
     * @param integer $telephone
     *
     * @return Utilisateur
     */
    public function setTelephone($telephone)
    {
        $this->telephone = $telephone;

        return $this;
    }

    /**
     * Get telephone
     *
     * @return integer
     */
    public function getTelephone()
    {
        return $this->telephone;
    }

    /**
     * Set address
     *
     * @param string $address
     *
     * @return Utilisateur
     */
    public function setAddress($address)
    {
        $this->address = $address;

        return $this;
    }

    /**
     * Get address
     *
     * @return string
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * Set codePostal
     *
     * @param string $codePostal
     *
     * @return Utilisateur
     */
    public function setCodePostal($codePostal)
    {
        $this->codePostal = $codePostal;

        return $this;
    }

    /**
     * Get codePostal
     *
     * @return string
     */
    public function getCodePostal()
    {
        return $this->codePostal;
    }

    /**
     * Set pays.
     *
     * @param string $pays
     *
     * @return Utilisateur
     */
    public function setPays($pays)
    {
        $this->pays = $pays;

        return $this;
    }

    /**
     * Get pays.
     *
     * @return string
     */
    public function getPays()
    {
        return $this->pays;
    }

    /**
     * Set ville.
     *
     * @param string $ville
     *
     * @return Utilisateur
     */
    public function setVille($ville)
    {
        $this->ville = $ville;

        return $this;
    }

    /**
     * Get ville.
     *
     * @return string
     */
    public function getVille()
    {
        return $this->ville;
    }

    /**
     * Set fax.
     *
     * @param int $fax
     *
     * @return Utilisateur
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax.
     *
     * @return int
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set img.
     *
     * @param string $img
     *
     * @return Utilisateur
     */
    public function setImg($img)
    {
        $this->img = $img;

        return $this;
    }

    /**
     * Get img.
     *
     * @return string
     */
    public function getImg()
    {
        return $this->img;
    }

    /**
     * Set cv.
     *
     * @param string $cv
     *
     * @return Utilisateur
     */
    public function setCv($cv)
    {
        $this->cv = $cv;

        return $this;
    }

    /**
     * Get cv.
     *
     * @return string
     */
    public function getCv()
    {
        return $this->cv;
    }
    public function __toString()
    {
        return parent::__toString();
    }
    /**
     * Set region.
     *
     * @param string $region
     *
     * @return Utilisateur
     */
    public function setRegion($region)
    {
        $this->region = $region;

        return $this;
    }

    /**
     * Get region.
     *
     * @return string
     */
    public function getRegion()
    {
        return $this->region;
    }

    /**
     * Set regime.
     *
     * @param \SuiviBundle\Entity\Regime|null $regime
     *
     * @return Utilisateur
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
