<?php

namespace App\Repository;

use App\Entities\Campaign;
use Doctrine\ORM\EntityManager;
use App\Entities\Voucher;

class CampaignRepository extends \Doctrine\ORM\EntityRepository
{

    public function save($data)
    {
        $em = $this->getEntityManager();
        if (isset($data['id'])) {
            $obj = $this->find($data['id']);
        } else {
            $obj = new Campaign();
        }
        $obj->setName($data['name']);
        $obj->setPeriode($data['period']);
        $obj->setType($data['type']);
        $obj->setVoucherCurrency($data['voucherCurrency']);
        $obj->setVoucherDuration($data['voucherDuration']);
        $obj->setVoucherPercentOff($data['voucherPercentOff']);
        $em->persist($obj);
        return $em->flush();
    }
}
