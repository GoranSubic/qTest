<?php

require_once "Classes/Student.php";
require_once "Classes/SchoolBoards.php";
require_once "bootstrap.php";

echo "<h1>Students board</h1>";

echo "<p><a href='?student=1'>Student 1 CSM board data</a></p>";
echo "<p><a href='?student=2'>Student 2 CSM board data</a></p>";
echo "<p><a href='?student=4'>Student 4 CSM board data</a></p>";

if(isset($_GET['student'])) {
    $studentId = $_GET['student'];

    $boardCSM = $entityManager->find('BoardCSM', $studentId);
    if ($boardCSM === null) {
        echo "No student found.\n";
        exit(1);
    }

    echo "<br />";
    echo json_encode($boardCSM->jsonSerialize());

}
