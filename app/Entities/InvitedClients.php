<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;
/**
 * Campaign
 *
 * @ORM\Entity(repositoryClass="App\Repository\InvitedClientsRepository")
 * @ORM\Table(name="invited_clients")
 */
class InvitedClients {

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="email_client", type="string", length=255)
     */
    private $emailClient;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entities\User")
     */
    private $user;

    /**
     * @ORM\Column(name="status", type="integer")
     */
    private $status = 0;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set emailClient
     *
     * @param string $emailClient
     *
     * @return InvitedClients
     */
    public function setEmailClient($emailClient)
    {
        $this->emailClient = $emailClient;

        return $this;
    }

    /**
     * Get emailClient
     *
     * @return string
     */
    public function getEmailClient()
    {
        return $this->emailClient;
    }

    /**
     * Set status
     *
     * @param integer $status
     *
     * @return InvitedClients
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return integer
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return InvitedClients
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set user
     *
     * @param \App\Entities\User $user
     *
     * @return InvitedClients
     */
    public function setUser(\App\Entities\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \App\Entities\User
     */
    public function getUser()
    {
        return $this->user;
    }
}
