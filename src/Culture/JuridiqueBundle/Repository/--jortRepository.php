<?php

namespace Culture\JuridiqueBundle\Repository;

/**
 * jortRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class jortRepository extends \Doctrine\ORM\EntityRepository
{
    public function findOrdrebByDate() {

        $query = $this->createQueryBuilder('a');
        $query->orderBy('a.date', 'DESC');
       
        return $query->getQuery()->getResult();
    }
}