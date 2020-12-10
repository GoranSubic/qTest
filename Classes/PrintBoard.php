<?php

require_once "PrintBoardInterface.php";
require_once "SchoolBoards.php";

class CSMBoardToJson implements PrintBoardInterface
{
    private $csmBoard;

    public function __construct(\BoardCSM $board = null)
    {
        $this->csmBoard = $board;
    }

    /**
     * Specify data which should be serialized to JSON
     * @link https://php.net/manual/en/jsonserializable.jsonserialize.php
     * @return mixed data which can be serialized by <b>json_encode</b>,
     * which is a value of any type other than a resource.
     * @since 5.4
     */
    public function export()
    {
        return [
            'result' => [
                'id' => $this->csmBoard->getStudent()->getId(),
                'name' => $this->csmBoard->getStudent()->getName(),
                'grade1' => $this->csmBoard->getStudent()->getGrade1(),
                'grade2' => $this->csmBoard->getStudent()->getGrade2(),
                'grade3' => $this->csmBoard->getStudent()->getGrade3(),
                'grade4' => $this->csmBoard->getStudent()->getGrade4(),
                'average' => $this->csmBoard->getAvgGrade(),
                'pass' => $this->csmBoard->isPass() ? "Pass" : "Fail"
            ]
        ];
    }
}

class CSMBBoardToXml implements PrintBoardInterface
{
    private $csmbBoard;

    public function __construct(\BoardCSMB $board = null)
    {
        $this->csmbBoard = $board;
    }

    public function export()
    {
        $xml = new DOMDocument("1.0");
        // It will format the output in xml format otherwise
        // the output will be in a single row
        $xml->formatOutput=true;
        $results = $xml->createElement("results");
        $xml->appendChild($results);

        $id=$xml->createElement("id", $this->csmbBoard->getStudent()->getId());
        $results->appendChild($id);

        $name = $xml->createElement("name", $this->csmbBoard->getStudent()->getName());
        $results->appendChild($name);

        $grade1 = $xml->createElement("grade1", $this->csmbBoard->getStudent()->getGrade1() ? $this->csmbBoard->getStudent()->getGrade1() : 0);
        $results->appendChild($grade1);

        $grade2 = $xml->createElement("grade2", $this->csmbBoard->getStudent()->getGrade2() ? $this->csmbBoard->getStudent()->getGrade2() : 0);
        $results->appendChild($grade2);

        $grade3 = $xml->createElement("grade3", $this->csmbBoard->getStudent()->getGrade3() ? $this->csmbBoard->getStudent()->getGrade3() : 0);
        $results->appendChild($grade3);

        $grade4 = $xml->createElement("grade4", $this->csmbBoard->getStudent()->getGrade4() ? $this->csmbBoard->getStudent()->getGrade4() : 0);
        $results->appendChild($grade4);

        $average = $xml->createElement("average", $this->csmbBoard->getAvgGrade());
        $results->appendChild($average);

        $pass = $xml->createElement("pass", $this->csmbBoard->isPass() ? "Pass" : "Fail");
        $results->appendChild($pass);

        echo htmlentities("<xml>".$xml->saveXML()."</xml>");
        $xml->save("resultsCSMB.xml");
    }
}

