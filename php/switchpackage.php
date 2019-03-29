<?php
include 'dbh.php';

if (isset($_GET['id'])) {
    $packages_id = $_GET['id'];
    $active = 1;
    $inactive = 0;
    $query = $conn->prepare('SELECT * FROM packages WHERE packages_id = :packages_id');
    $query->execute(array(
        ':packages_id' => $packages_id
    ));

    $presult = $query->fetch();

    $query1 = $conn->prepare('SELECT * FROM packages WHERE classes = :classes ');
    $query1->execute(array(
        ':classes' => $presult['classes']
    ));


    $classresult = $query1->fetchAll(PDO::FETCH_ASSOC);
    echo '<pre>', print_r($classresult, 1), '</pre>';


    if ($presult['active'] == 1) {
        $query2 = $conn->prepare('UPDATE packages SET active = :inactive WHERE packages_id = :packages_id');
        $query2->execute(array(
            ':inactive' => $inactive,
            ':packages_id' => $packages_id
        ));

        $_SESSION['succes'] = 'Succesfully changed the status';
        header('Location: ../index.php?page=package');
    }
    else {
        for ($i = 0; $i < $query1->rowCount(); $i++) {
            if ($classresult[$i]['active'] == 1) {
                $query2 = $conn->prepare('UPDATE packages SET active = :inactive WHERE packages_id = :packages_id');
                $query2->execute(array(
                    ':inactive' => $inactive,
                    ':packages_id' => $classresult[$i]['packages_id']
                ));

                $query3 = $conn->prepare('UPDATE packages SET active = :active WHERE packages_id = :packages_id');
                $query3->execute(array(
                    ':active' => $active,
                    ':packages_id' => $packages_id
                ));

                $_SESSION['succes'] = 'Succesfully changed the status';
                header('Location: ../index.php?page=package');
            }
        }
    }
}