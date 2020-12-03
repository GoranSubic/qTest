<?php

require_once "Classes/Student.php";
require_once "Classes/SchoolBoards.php";
require_once "bootstrap.php";

echo "<h1>Students board</h1>";

echo "<p><a href='?student=1'>Student 1 board data</a></p>";
echo "<p><a href='?student=2'>Student 2 board data</a></p>";
echo "<p><a href='?student=3'>Student 3 board data</a></p>";
echo "<p><a href='?student=4'>Student 4 board data</a></p>";
echo "<br /><p><a href='?student=5'>Student 5 CSM board data</a></p>";

if(isset($_GET['student'])) {
    $studentId = $_GET['student'];

    $boardCSM = $entityManager->find('BoardCSM', $studentId);
    if ($boardCSM === null) {
        echo "CSM No student found.\n";
        exit(1);
    }

    echo "<hr>";
    echo "<h2>CSM Board data</h2>";
    echo "<br />";
    echo json_encode($boardCSM->jsonSerialize());

    echo "<br /><br />";

    echo "<hr>";
    echo "<h2>CSMB Board data</h2>";
    echo "<br />";

    $boardCSMB = $entityManager->find('BoardCSMB', $studentId);
    if ($boardCSMB === null) {
        echo "CSMB No student found.\n";
        exit(1);
    }
    echo "<pre>".$boardCSMB->xmlData()."</pre>";
}
