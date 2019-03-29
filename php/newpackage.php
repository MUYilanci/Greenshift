<?php
include 'dbh.php';

if (isset($_POST['submit'])) {
    $class = htmlspecialchars($_POST['class']);
    $price = htmlspecialchars($_POST['price']);
    $active = htmlspecialchars($_POST['active']);

    $query = $conn->prepare('INSERT INTO packages (classes, price, active) VALUES (:class, :price, :active)');
    $query->execute(array(
        ':class' => $class,
        ':price' => $price,
        ':active' => $active
    ));

    $_SESSION['succes'] = 'Succesfully added a package';
    header('Location: ../index.php?page=package');
}
else{
    $_SESSION['error'] = "Something Went Wrong";
    header('Location: ../index.php?page=newpackage');
}