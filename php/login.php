<?php
include 'dbh.php';
session_start();

if (isset($_POST['submit'])) {
    $loginusername = $_POST['username'];
    $loginpassword = $_POST['password'];
}

$query = $conn->prepare('SELECT * FROM user WHERE username=:username');

$query->execute(array(
    ':username' => $loginusername
));

$result = $query->fetch(PDO::FETCH_ASSOC);

if ($query->rowCount() > 0 && password_verify($loginpassword, $result['password'])) {
    $_SESSION['login'] = true;
    $_SESSION['user_id'] = $result['user_id'];
    $_SESSION['username'] = $result['username'];
    $role = $result['role'];

    if (isset($role)) {
        $_SESSION['role'] = $role;
        header("Location: ../?page=home");
        if ($role == 'instructor'){
            $query1 = $conn->prepare('SELECT * FROM instructor WHERE user_id = :user_id');
            $query1->execute(array(
               ':user_id' => $result['user_id']
            ));
            $result1 = $query1->fetch();
            $_SESSION['instructor_id'] = $result1['instructor_id'];
            $_SESSION['hours'] = $result1['hours'];
        }
        else if ($role == 'student'){
            $query2 = $conn->prepare('SELECT * FROM student WHERE user_id = :user_id');
            $query2->execute(array(
                ':user_id' => $result['user_id']
            ));
            $result2 = $query2->fetch();
            $_SESSION['instructor_id'] = $result2['instructor_id'];
            $_SESSION['student_id'] = $result2['student_id'];
        }

    }
    else {
        $_SESSION['error'] = "you have no role try contacting";
        header("Location: ../?page=login");
    }
}
else {
    $_SESSION['error'] = "Username and/or password incorrect";
    header("Location: ../?page=login");
}
?>


