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
        /*if ($count == 0)  {
            throw new Exception("This student has none grades!");
        }*/
        $this->avgGrade = $count > 0 ? $sum / $count : 0;
        $this->avgGrade >= 7 ? $this->pass = true : $this->pass = false;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function jsonSerialize()
    {
        return [
            'result' => [
                'id' => $this->student->getId(),
                'name' => $this->student->getName(),
                'grade1' => $this->student->getGrade1(),
                'grade2' => $this->student->getGrade2(),
                'grade3' => $this->student->getGrade3(),
                'grade4' => $this->student->getGrade4(),
                'average' => $this->avgGrade,
                'pass' => $this->pass ? "Pass" : "Fail"
            ]
        ];
    }
}

/**
 * @ORM\Entity(repositoryClass="CSMBoardRepository")
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

    public function xmlData()
    {
        $xml = new DOMDocument("1.0");
        // It will format the output in xml format otherwise
        // the output will be in a single row
        $xml->formatOutput=true;
        $results = $xml->createElement("results");
        $xml->appendChild($results);


        $id=$xml->createElement("id", $this->student->getId());
        $results->appendChild($id);

        $name = $xml->createElement("name", $this->student->getName());
        $results->appendChild($name);

        $grade1 = $xml->createElement("grade1", $this->student->getGrade1() ? $this->student->getGrade1() : 0);
        $results->appendChild($grade1);

        $grade2 = $xml->createElement("grade2", $this->student->getGrade2() ? $this->student->getGrade2() : 0);
        $results->appendChild($grade2);

        $grade3 = $xml->createElement("grade3", $this->student->getGrade3() ? $this->student->getGrade3() : 0);
        $results->appendChild($grade3);

        $grade4 = $xml->createElement("grade4", $this->student->getGrade4() ? $this->student->getGrade4() : 0);
        $results->appendChild($grade4);

        $average = $xml->createElement("average", $this->avgGrade);
        $results->appendChild($average);

        $pass = $xml->createElement("pass", $this->pass ? "Pass" : "Fail");
        $results->appendChild($pass);

        echo htmlentities("<xml>".$xml->saveXML()."</xml>");
        $xml->save("resultsCSMB.xml");
    }
}
