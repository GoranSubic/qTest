<?php

require_once "Classes/Student.php";
require_once "Classes/SchoolBoards.php";
require_once "bootstrap.php";

$student0 = new Student("Student0 Name0");
$boardCSMB0 = new BoardCSMB($student0);
$boardCSM0 = new BoardCSM($student0);
try {
    $boardCSMB0->calcBoard();
    $boardCSM0->calcBoard();
} catch(Exception $e) {
    echo $e->getMessage();
}
$entityManager->persist($boardCSMB0);
$entityManager->persist($boardCSM0);
$entityManager->persist($student0);

$student1 = new Student("Student1 Name1", 6, 7);
$boardCSMB1 = new BoardCSMB($student1);
$boardCSM1 = new BoardCSM($student1);
$boardCSMB1->calcBoard();
$boardCSM1->calcBoard();
$entityManager->persist($boardCSMB1);
$entityManager->persist($boardCSM1);
$entityManager->persist($student1);

$student2 = new Student("Student2 Name2", 6, 7, 8);
$boardCSMB2 = new BoardCSMB($student2);
$boardCSM2 = new BoardCSM($student2);
$boardCSMB2->calcBoard();
$boardCSM2->calcBoard();
$entityManager->persist($boardCSMB2);
$entityManager->persist($boardCSM2);
$entityManager->persist($student2);

$student3 = new Student("Student3 Name3", 5, 7, 9, 10);
$boardCSMB3 = new BoardCSMB($student3);
$boardCSM3 = new BoardCSM($student3);
$boardCSMB3->calcBoard();
$boardCSM3->calcBoard();
$entityManager->persist($boardCSMB3);
$entityManager->persist($boardCSM3);
$entityManager->persist($student3);

$entityManager->flush();
