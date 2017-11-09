<?php

namespace App\Entities;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping AS ORM;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * @ORM\Table(name="voucher")
 * @ORM\Entity(repositoryClass="App\Repository\VoucherRepository")
 */
class Voucher
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=60, name="code")
     */
    private $code;

    /**
     * @var integer
     *
     * @ORM\ManyToOne(targetEntity="App\Entities\User")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="App\Entities\Campaign")
     */
    private $campaign;

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
     * Set code
     *
     * @param string $code
     *
     * @return Voucher
     */
    public function setCode($code)
    {
        $this->code = $code;

        return $this;
    }

    /**
     * Get code
     *
     * @return string
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Voucher
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
     * @return Voucher
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

    /**
     * Set campaign
     *
     * @param \App\Entities\Campaign $campaign
     *
     * @return Voucher
     */
    public function setCampaign(\App\Entities\Campaign $campaign = null)
    {
        $this->campaign = $campaign;

        return $this;
    }

    /**
     * Get campaign
     *
     * @return \App\Entities\Campaign
     */
    public function getCampaign()
    {
        return $this->campaign;
    }
}
