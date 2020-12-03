<?php

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="student")
 */
class Student
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50, nullable=false)
     * @var $name
     */
    private $name;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var $grade1
     */
    protected $grade1;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var $grade2
     */
    protected $grade2;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var $grade3
     */
    protected $grade3;

    /**
     * @ORM\Column(type="integer", nullable=true)
     * @var $grade4
     */
    protected $grade4;

    public function __construct($name, $grade1 = null, $grade2 = null, $grade3 = null, $grade4 = null)
    {
        $this->name = $name;
        $this->grade1 = $grade1;
        $this->grade2 = $grade2;
        $this->grade3 = $grade3;
        $this->grade4 = $grade4;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getGrade1()
    {
        return $this->grade1;
    }

    /**
     * @param mixed $grade1
     */
    public function setGrade1($grade1): void
    {
        $this->grade1 = $grade1;
    }

    /**
     * @return mixed
     */
    public function getGrade2()
    {
        return $this->grade2;
    }

    /**
     * @param mixed $grade2
     */
    public function setGrade2($grade2): void
    {
        $this->grade2 = $grade2;
    }

    /**
     * @return mixed
     */
    public function getGrade3()
    {
        return $this->grade3;
    }

    /**
     * @param mixed $grade3
     */
    public function setGrade3($grade3): void
    {
        $this->grade3 = $grade3;
    }

    /**
     * @return mixed
     */
    public function getGrade4()
    {
        return $this->grade4;
    }

    /**
     * @param mixed $grade4
     */
    public function setGrade4($grade4): void
    {
        $this->grade4 = $grade4;
    }

}