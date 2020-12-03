<?php

require_once "bootstrap.php";

use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\EntityManagerInterface;

class StudentsCRUD extends EntityRepository
{
    protected $em;

    public function __construct(EntityManagerInterface $em, ORM $class)
    {
        parent::__construct($em, $class);
    }

    public function showStudent($id)
    {
        $query = $this->getEntityManager()->createQuery("SELECT * FROM student WHERE id =" .$id);
        $student = $query->getResult();

        var_dump($student);

        return $student;
    }
}