<?php
include 'dbh.php';
session_start();

if (isset($_POST['submit'])) {

    if ($_POST['password'] == $_POST['repeat_password']) {

        $registerusername = htmlspecialchars($_POST['username']);
        $registerpassword = htmlspecialchars($_POST['password']);
        $role = 'instructor';
        $registername = htmlspecialchars($_POST['name']);
        $registersurname = htmlspecialchars($_POST['surname']);
        $registeremail = htmlspecialchars($_POST['email']);
        $registerphone = htmlspecialchars($_POST['phone']);
        $registerhours = htmlspecialchars($_POST['hours']);


        $query = $conn->prepare('SELECT * FROM `user` WHERE username=:username');
        $query->execute(array(
            ':username' => $registerusername
        ));

        if ($query->rowCount() == 0) {
            $query1 = $conn->prepare("INSERT INTO `user` (username, password, role) VALUES (:username, :password, :role)");
            $query1->execute(array(
                ':username' => $registerusername,
                ':password' => password_hash($registerpassword, PASSWORD_DEFAULT),
                ':role' => $role
            ));

            $query2 = $conn->prepare("SELECT * FROM `user` WHERE username = :username");
            $query2->execute(array(
                ':username' => $registerusername
            ));

            $user_id = $query2->fetch();

            $query3 = $conn->prepare("INSERT INTO  `instructor` (`name`, `surname`, `email`, `phone`, `hours`, `user_id` ) VALUES (:name, :surname, :email, :phone, :hours, :user_id)") ;
            $query3->execute(array(
                ':name' => $registername,
                ':surname' => $registersurname,
                ':email' => $registeremail,
                ':phone' => $registerphone,
                ':hours' => $registerhours,
                ':user_id' => $user_id['user_id']
            ));

            $_SESSION['register'] = 'Registration succesfully';
            header('Location: ../index.php?page=usermanagement');
        }
        else {
            $_SESSION['error'] = "Username already exists";
            header('Location: ../index.php?page=newinstructor');
        }
    }
    else {
        $_SESSION['error'] = "Passwords are not the same";
        header('Location: ../index.php?page=newinstructor');
    }
}
else{
    $_SESSION['error'] = "Something Went Wrong";
    header('Location: ../index.php?page=newinstructor');
}