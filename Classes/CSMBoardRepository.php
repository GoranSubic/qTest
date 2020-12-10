<?php

use Doctrine\ORM\EntityRepository;

require_once "PrintBoard.php";

class CSMBoardRepository extends EntityRepository
{
    public function findById($studentId)
    {
        $dql = "SELECT b, s FROM BoardCSM b JOIN b.student s WHERE s.id = ?1";

        $board = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $studentId)
            ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_OBJECT)
        ;
        if(!$board) return null;

        $csmBoardJson = new CSMBoardToJson($board);

        return $csmBoardJson ? $csmBoardJson->export() : null;
    }
}