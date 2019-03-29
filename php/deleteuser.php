<?php
include 'dbh.php';
$instructor_id = $_POST['instructor_id'];

$query1 = $conn->prepare('SELECT * FROM `instructor` WHERE instructor_id = :instructor_id');
$query1->execute(
    [
        "instructor_id" => $instructor_id
    ]
);

$user_id = $query1->fetch();

$query2 = $conn->prepare('DELETE FROM  `user` WHERE user_id = :user_id');
$query2->execute(
    [
        ":user_id" => $user_id['user_id']
    ]
);

$query = $conn->prepare('DELETE FROM `instructor` WHERE instructor_id= :instructor_id');
$query->execute(
    [
        ":instructor_id" => $instructor_id
    ]
);

header('Location: ./../?page=usermanagement');