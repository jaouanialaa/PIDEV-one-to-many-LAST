<?php
/**
 * Created by PhpStorm.
 * User: jaoua
 * Date: 20/02/2018
 * Time: 12:18
 */

namespace SuiviBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use FOS\MessageBundle\Entity\MessageMetadata as BaseMessageMetadata;

/**
 * @ORM\Entity
 */
class MessageMetadata extends BaseMessageMetadata
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(
     *   targetEntity="SuiviBundle\Entity\Message",
     *   inversedBy="metadata"
     * )
     * @var \FOS\MessageBundle\Model\MessageInterface
     */
    protected $message;

    /**
     * @ORM\ManyToOne(targetEntity="GUBundle\Entity\Utilisateur")
     * @var \FOS\MessageBundle\Model\ParticipantInterface
     */
    protected $participant;
}