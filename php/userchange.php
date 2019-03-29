<?php
include 'dbh.php';
session_start();

$instructor_id = htmlspecialchars($_SESSION['instructor_id']);
$name = htmlspecialchars($_POST['name']);
$surname = htmlspecialchars($_POST['surname']);
$email = htmlspecialchars($_POST['email']);
$phone = htmlspecialchars($_POST['phone']);
$hours = htmlspecialchars(  $_POST['hours']);

$query = $conn->prepare('UPDATE instructor SET name=:name, surname=:surname, email=:email, phone=:phone, hours=:hours WHERE instructor_id = :instructor_id');
$query->execute(
    [
        ":name" => $name,
        ":surname" => $surname,
        ":email" => $email,
        ":phone" => $phone,
        ":hours" => $hours,
        ":instructor_id" => $instructor_id
    ]
);

header('Location: ../index.php?page=usermanagement');