<?php

use Doctrine\ORM\EntityRepository;

require_once "PrintBoard.php";

class CSMBBoardRepository extends EntityRepository
{
    public function findById($studentId)
    {
        $dql = "SELECT b, s FROM BoardCSMB b JOIN b.student s WHERE s.id = ?1";

        $board = $this->getEntityManager()->createQuery($dql)
            ->setParameter(1, $studentId)
            ->getOneOrNullResult(\Doctrine\ORM\Query::HYDRATE_OBJECT)
        ;
        if(!$board) return null;

        $csmbBoardXml = new CSMBBoardToXml($board);

        return $csmbBoardXml ? $csmbBoardXml->export() : null;
    }
}