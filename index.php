<?php

require_once "Classes/Student.php";
require_once "Classes/SchoolBoards.php";
require_once "bootstrap.php";

echo "<h1>Students board</h1>";

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
