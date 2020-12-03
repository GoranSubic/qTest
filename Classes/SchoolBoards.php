<?php

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/** @ORM\MappedSuperclass */
abstract class SchoolBoards
{
    /**
     * @ORM\OneToOne(targetEntity="Student")
     * @ORM\JoinColumn(name="student_id", referencedColumnName="id")
     */
    protected Student $student;

    /** @ORM\Column(type="float", nullable=true) */
    protected $avgGrade;

    /** @ORM\Column(type="boolean") */
    protected $pass = false;

    abstract public function calcBoard();
}

/**
 * @ORM\Entity
 * @ORM\Table(name="board_csm")
 */
class BoardCSM extends SchoolBoards implements JsonSerializable
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

        $this->avgGrade = $sum / $count;
        $this->avgGrade >= 7 ? $this->pass = true : $this->pass = false;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize() {
        return [
            'result' => [
                'id' => $this->student->getId(),
                'name' => $this->student->getName(),
                'grade1' => $this->student->getGrade1(),
                'grade2' => $this->student->getGrade2(),
                'grade3' => $this->student->getGrade3(),
                'grade4' => $this->student->getGrade4(),
                'average' => $this->avgGrade,
                'pass' => $this->pass
            ]
        ];
    }
}

class BoardCSMB extends SchoolBoards
{
    public function calcBoard()
    {
        // TODO: Implement calcBoard() method.
    }
}
