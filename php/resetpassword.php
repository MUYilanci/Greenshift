<?php
include 'dbh.php';
session_start();

if (isset($_POST['submit'])) {

    if (isset($_POST['password']) && $_POST['password'] == $_POST['repeat_password']) {

        $reset_password = $_POST['password'];
        $user_id = $_POST['user_id'];

        $query = $conn->prepare('UPDATE users SET password=:password WHERE user_id =:user_id');
        $query->execute(array(
            ':password' => $reset_password,
            ':user_id' => $user_id
        ));

        $_SESSION['resetcompleted'] = 'Password succesfully changed';
        header('Location: ../index.php?page=login');
    }
    else {
        $_SESSION['passworderror'] = 'Passwords are not the same';
        header('Location: ../index.php?page=resetpassword');
    }
}
