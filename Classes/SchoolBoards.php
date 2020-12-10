<?php

use Doctrine\ORM\Mapping as ORM;

require_once "CSMBoardRepository.php";
require_once "CSMBBoardRepository.php";

/** @ORM\MappedSuperclass */
abstract class SchoolBoards
{
    /**
     * @ORM\OneToOne(targetEntity="Student")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    protected Student $student;

    /** @ORM\Column(type="float", nullable=true) */
    protected $avgGrade = 0;

    /** @ORM\Column(type="boolean") */
    protected $pass = false;

    abstract public function calcBoard();
}

/**
 * @ORM\Entity(repositoryClass="CSMBoardRepository")
 * @ORM\Table(name="board_csm")
 */
class BoardCSM extends SchoolBoards
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @param Student $student
     */
    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }

    /**
     * @return int
     */
    public function getAvgGrade(): int
    {
        return $this->avgGrade;
    }

    /**
     * @param int $avgGrade
     */
    public function setAvgGrade(int $avgGrade): void
    {
        $this->avgGrade = $avgGrade;
    }

    /**
     * @return bool
     */
    public function isPass(): bool
    {
        return $this->pass;
    }

    /**
     * @param bool $pass
     */
    public function setPass(bool $pass): void
    {
        $this->pass = $pass;
    }

    public function calcBoard()
    {
        $count = 0;
        $sum = 0;

        if ($this->student->getGrade1()) {
            $sum += $this->student->getGrade1();
            $count++;
        }

        if ($this->student->getGrade2()) {
            $sum += $this->student->getGrade2();
            $count++;
        }

        if ($this->student->getGrade3()) {
            $sum += $this->student->getGrade3();
            $count++;
        }

        if ($this->student->getGrade4()) {
            $sum += $this->student->getGrade4();
            $count++;
        }
        /*if ($count == 0)  {
            throw new Exception("This student has none grades!");
        }*/
        $this->avgGrade = $count > 0 ? $sum / $count : 0;
        $this->avgGrade >= 7 ? $this->pass = true : $this->pass = false;
    }

}

/**
 * @ORM\Entity(repositoryClass="CSMBBoardRepository")
 * @ORM\Table(name="board_csmb")
 */
class BoardCSMB extends SchoolBoards
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer")
     * @ORM\GeneratedValue
     * @var int
     */
    private $id;

    public function __construct(Student $student)
    {
        $this->student = $student;
    }

    /**
     * @return int
     */
    public function getId(): int
    {
        return $this->id;
    }

    /**
     * @return Student
     */
    public function getStudent(): Student
    {
        return $this->student;
    }

    /**
     * @param Student $student
     */
    public function setStudent(Student $student): void
    {
        $this->student = $student;
    }

    /**
     * @return int
     */
    public function getAvgGrade(): int
    {
        return $this->avgGrade;
    }

    /**
     * @param int $avgGrade
     */
    public function setAvgGrade(int $avgGrade): void
    {
        $this->avgGrade = $avgGrade;
    }

    /**
     * @return bool
     */
    public function isPass(): bool
    {
        return $this->pass;
    }

    /**
     * @param bool $pass
     */
    public function setPass(bool $pass): void
    {
        $this->pass = $pass;
    }

    public function calcBoard()
    {
        $count = 0;
        $sum = 0;
        $lowest = $this->student->getGrade1() > 0 ?$this->student->getGrade1() : 0;
        $biggest = $this->student->getGrade1() > 0 ?$this->student->getGrade1() : 0;

        if ($this->student->getGrade1()) {
            $sum += $this->student->getGrade1();
            $count++;
        }

        if ($this->student->getGrade2()) {
            $sum += $this->student->getGrade2();
            $count++;
            $lowest = ($lowest < $this->student->getGrade2()) ? $lowest : $this->student->getGrade2();
            $biggest = ($biggest > $this->student->getGrade2()) ? $biggest : $this->student->getGrade2();
        }

        if ($this->student->getGrade3()) {
            $sum += $this->student->getGrade3();
            $count++;
            $lowest = ($lowest < $this->student->getGrade3()) ? $lowest : $this->student->getGrade3();
            $biggest = ($biggest > $this->student->getGrade3()) ? $biggest : $this->student->getGrade3();
        }

        if ($this->student->getGrade4()) {
            $sum += $this->student->getGrade4();
            $count++;
            $lowest = ($lowest < $this->student->getGrade4()) ? $lowest : $this->student->getGrade4();
            $biggest = ($biggest > $this->student->getGrade4()) ? $biggest : $this->student->getGrade4();
        }

        if ($count > 2) {
            $sum -= $lowest;
            $count--;
        }

        /*if ($count == 0)  {
            throw new Exception("This student has none grades!");
        }*/
        $this->avgGrade = $count > 0 ? $sum / $count : 0;
        $this->pass = ($biggest > 8) ? true : false;
    }

}
