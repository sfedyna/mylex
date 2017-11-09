<?php

namespace App\Repository;

use App\Entities\Campaign;
use Doctrine\ORM\EntityManager;
use App\Entities\Voucher;

class InvitedClientsRepository extends \Doctrine\ORM\EntityRepository
{
    public function updateStatus($userId, $status)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQueryBuilder();
        $q = $qb->update('App\Entities\InvitedClients', 'ic')
            ->set('ic.status', $status)
            ->where($qb->expr()->eq('ic.user', $userId ))
            ->getQuery();
        return $q->execute();
    }
}
