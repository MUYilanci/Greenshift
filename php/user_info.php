<?php
include 'dbh.php';
session_start();

if (isset($_POST['submit'])) {
    $email = $_POST['email'];
}

$query = $conn->prepare('SELECT * FROM users WHERE email=:email');
$query->execute(array(
    ':email' => $email
));

if ($query->rowCount() > 0) {
    $result = $query->fetch(PDO::FETCH_ASSOC);
    $_SESSION['mail'] = $result['mail'];
    header("Location: ../?page=resetpasswordtest");

} else {
    $_SESSION['error'] = "Name and/or username isn't recognized";
    header("Location: ../?page=user_info");
}


//if ($query->rowCount() > 0) {
//    $result = $query->fetch(PDO::FETCH_ASSOC);
//    $_SESSION['user_id'] = $result['user_id'];
//    header("Location: ../?page=resetpassword");
//
//} else {
//    $_SESSION['error'] = "Name and/or username isn't recognized";
//    header("Location: ../?page=user_info");
//}