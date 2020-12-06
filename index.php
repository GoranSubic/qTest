<?php

require_once "bootstrap.php";
require_once "Classes/SchoolBoards.php";
require_once "Classes/Student.php";

echo "<h1>Students board</h1>";

echo "<p><a href='?student=1'>Student 1 board data</a></p>";
echo "<p><a href='?student=2'>Student 2 board data</a></p>";
echo "<p><a href='?student=3'>Student 3 board data</a></p>";
echo "<p><a href='?student=4'>Student 4 board data</a></p>";
echo "<br /><p><a href='?student=5'>Student 5 CSM board data</a></p>";

if(isset($_GET['student'])) {
    $studentId = $_GET['student'];

    echo "<hr>";
    echo "<h2>REPOSITORY - CSM Board data</h2>";
    echo "<br />";
    $repoCSMBoard = $entityManager->getRepository(BoardCSM::class)->findById($studentId);
    if ($repoCSMBoard === null) {
        echo "Repository - CSM No student found.\n";
        exit(1);
    }
    echo json_encode($repoCSMBoard);

    echo "<br /><br />";
    echo "<hr>";
    echo "<h2>REPOSITORY - CSMB Board data</h2>";
    echo "<br />";
    $repoCSMBBoard = $entityManager->getRepository(BoardCSMB::class)->findByStudent($studentId);
    if ($repoCSMBBoard === null) {
        echo "Repository - CSMB No student found.\n";
        exit(1);
    }
    echo "<pre>".$repoCSMBBoard[0]->xmlData()."</pre>";
}
