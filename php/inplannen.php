<?php
include 'dbh.php';
session_start();
$time = $_POST['time'];

if (isset($_POST['time'])) {
    $data1 = implode(" ", $time);
    $data = explode(" ", $data1);

    $query1 = $conn->prepare('UPDATE `class` SET student_id= :student_id WHERE instructor_id= :instructor_id AND date = :date AND starthour= :starthour');
    $query1->execute(array(
        ':student_id' => $_SESSION['student_id'],
        ':instructor_id' => $_SESSION['instructor_id'],
        ':date' => $data[1],
        ':starthour' => $data[0]
    ));
    $_SESSION['succes'] = "Succesfully planned your lesson!";
    header("Location: ../?page=inplannen");
} else {
    $_SESSION['error'] = "Something Went Wrong";
    header("Location: ../?page=inplannen");
}