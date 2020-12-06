<?php

use Doctrine\ORM\EntityRepository;

class CSMBBoardRepository extends EntityRepository
{
    public function findByStudent($studentId)
    {
        $dql = "SELECT b, s FROM BoardCSMB b JOIN b.student s WHERE s.id = ?1";

        $result = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $studentId)
            ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_OBJECT)
        ;

        return $result;
    }
}