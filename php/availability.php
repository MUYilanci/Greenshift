<?php
include 'dbh.php';
session_start();
$time = $_POST['time'];
$date = date('Y/m/d');
if (isset($_POST)) {
    echo $_SESSION['monday'];
    echo '<br>';
    echo $_SESSION['saturday'];

    $delete = $conn->prepare('DELETE FROM class WHERE instructor_id = :instructor_id AND student_id IS NULL AND date BETWEEN :startday AND :endday ');
    $delete->execute(array(
        ':instructor_id' => $_SESSION['instructor_id'],
        ':startday' => $_SESSION['monday'],
        ':endday' => $_SESSION['saturday']
    ));

    $data1 = implode(" ", $time);
    $data = explode(" ", $data1);

        for ($i = 0; $i < count($data); $i += 2) {
            $query = $conn->prepare('INSERT INTO `class`(`instructor_id`, `date`, `starthour`) VALUES (:instructor_id, :date, :starthour)');
            $query->execute(array(
                ':instructor_id' => $_SESSION['instructor_id'],
                ':date' => $data[$i + 1],
                ':starthour' => $data[$i]
            ));
        }
    $_SESSION['succes'] = "Planning succecsfull";
    header("Location: ../?page=availability");
} else {
    $_SESSION['error'] = " Something Went Wrong";
    header("Location: ../?page=availability");
}

