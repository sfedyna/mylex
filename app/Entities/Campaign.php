<?php

namespace App\Entities;

use Doctrine\ORM\Mapping AS ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Gedmo\Mapping\Annotation as Gedmo;

/**
 * Campaign
 *
 * @ORM\Entity
 * @ORM\Table(name="campaign")
 * @ORM\Entity(repositoryClass="App\Repository\CampaignRepository")
 */
class Campaign
{

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
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var string
     *
     * @ORM\Column(name="type", type="string", length=60)
     */
    private $type;

    /**
     * @ORM\Column(name="voucher_duration", type="string", length=60)
     */
    private $voucherDuration;

    /**
     * @ORM\Column(name="voucher_percent_off", type="integer")
     */
    private $voucherPercentOff;

    /**
     * @ORM\Column(name="voucher_currency", length=3, name="currency")
     */
    private $voucherCurrency;

    /**
     * @ORM\Column(name="periode", type="datetime", nullable=true)
     */
    private $periode;

    /**
     * @var \DateTime $created
     *
     * @ORM\Column(name="created_at", type="datetime")
     * @Gedmo\Timestampable(on="create")
     */
    private $created;

    /**
     * @var \DateTime $updated
     * @Gedmo\Timestampable(on="update")
     * @ORM\Column(name="updated_at", type="datetime", nullable=true)
     */
    private $updated;

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
     * Set name
     *
     * @param string $name
     *
     * @return Campaign
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Campaign
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }


    /**
     * Set voucherDuration
     *
     * @param string $voucherDuration
     *
     * @return Campaign
     */
    public function setVoucherDuration($voucherDuration)
    {
        $this->voucherDuration = $voucherDuration;

        return $this;
    }

    /**
     * Get voucherDuration
     *
     * @return string
     */
    public function getVoucherDuration()
    {
        return $this->voucherDuration;
    }

    /**
     * Set voucherPercentOff
     *
     * @param integer $voucherPercentOff
     *
     * @return Campaign
     */
    public function setVoucherPercentOff($voucherPercentOff)
    {
        $this->voucherPercentOff = $voucherPercentOff;

        return $this;
    }

    /**
     * Get voucherPercentOff
     *
     * @return integer
     */
    public function getVoucherPercentOff()
    {
        return $this->voucherPercentOff;
    }

    /**
     * Set voucherCurrency
     *
     * @param string $voucherCurrency
     *
     * @return Campaign
     */
    public function setVoucherCurrency($voucherCurrency)
    {
        $this->voucherCurrency = $voucherCurrency;

        return $this;
    }

    /**
     * Get voucherCurrency
     *
     * @return string
     */
    public function getVoucherCurrency()
    {
        return $this->voucherCurrency;
    }


    /**
     * Set periode
     *
     * @param \DateTime $periode
     *
     * @return Campaign
     */
    public function setPeriode($periode)
    {
        $this->periode = new \DateTime($periode);

        return $this;
    }

    /**
     * Get periode
     *
     * @return \DateTime
     */
    public function getPeriode()
    {
        return $this->periode;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Campaign
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
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Campaign
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }
}
