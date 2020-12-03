<?php

require_once "Classes/Student.php";
require_once "Classes/SchoolBoards.php";
require_once "bootstrap.php";

$student1 = new Student("Student1 Name1", 6, 7);
$boardCSM1 = new BoardCSM($student1);
$boardCSM1->calcBoard();
$entityManager->persist($boardCSM1);
$entityManager->persist($student1);


$student2 = new Student("Student2 Name2", 6, 7, 8);
$boardCSM2 = new BoardCSM($student2);
$boardCSM2->calcBoard();
$entityManager->persist($boardCSM2);
$entityManager->persist($student2);

$student3 = new Student("Student3 Name3", 5, 7, 9, 10);
$boardCSM3 = new BoardCSM($student3);
$boardCSM3->calcBoard();
$entityManager->persist($boardCSM3);
$entityManager->persist($student3);

$entityManager->flush();
