<?php

namespace Estina\Bundle\HomeBundle\Entity;

use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function findActiveTalks()
    {
        $qb = $this->_em->createQueryBuilder();
        $qb
            ->select('t')
            ->from('Estina\Bundle\HomeBundle\Entity\User', 'u')
            ->where('u.active = 1')
            ->orderBy('u.createdOn', 'DESC');

        return $qb->getQuery()->getResult();
    }
}