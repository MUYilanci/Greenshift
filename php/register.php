<?php
include 'dbh.php';
session_start();

if (isset($_POST['submit'])) {

    if ($_POST['password'] == $_POST['repeat_password']) {

        $registerusername = htmlspecialchars($_POST['username']);
        $registerpassword = htmlspecialchars($_POST['password']);
        $role = 'student';
        $registername = htmlspecialchars($_POST['name']);
        $registersurname = htmlspecialchars($_POST['surname']);
        $registeradress = htmlspecialchars($_POST['adress']);
        $registerzipcode = htmlspecialchars($_POST['zipcode']);
        $registeremail = htmlspecialchars($_POST['email']);
        $registerphone = htmlspecialchars($_POST['phone']);
        $registerinstructor_id = htmlspecialchars($_POST['instructor_id']);


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

            echo $registerinstructor_id;
         $query3 = $conn->prepare("INSERT INTO  `student` (`name`, `surname`, `adress`, `zip-code`, `email`, `phone`, `user_id`, `instructor_id`) VALUES (:name, :surname, :adress, :zipcode, :email, :phone, :user_id, :instructor_id)") ;
            $query3->execute(array(
            ':name' => $registername,
            ':surname' => $registersurname,
            ':adress' => $registeradress,
            ':zipcode' => $registerzipcode,
            ':email' => $registeremail,
            ':phone' => $registerphone,
            ':user_id' => $user_id['user_id'],
            ':instructor_id' =>  $registerinstructor_id
            ));

            $_SESSION['register'] = 'Registration succesfully';
            header('Location: ../index.php?page=login');
        }
        else {
            $_SESSION['error'] = "Username already exists";
            header('Location: ../index.php?page=register');
        }
    }
    else {
        $_SESSION['error'] = "Passwords are not the same";
        header('Location: ../index.php?page=register');
    }
}