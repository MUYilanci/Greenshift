<?php
include "php/dbh.php";
if (isset($_GET['start'])) {
    $thismonday = $_GET['start'];
} else {
    $today = date("Y/m/d");
    $thismonday = date('Y/m/d', strtotime('previous monday', strtotime($today)));
}

$thissaturday = date('Y/m/d', strtotime('+5 days', strtotime($thismonday)));
$lastmonday = date('Y/m/d', strtotime('-7 days', strtotime($thismonday)));
$nextmonday = date('Y/m/d', strtotime('+7 days', strtotime($thismonday)));
$lastsaturday = date('Y/m/d', strtotime('+5 days', strtotime($lastmonday)));
$weeknumber = date('W', strtotime($thismonday));
$f = 0;
$n = 0;
$starthour = 8;
$startday = $thismonday;
$_SESSION['monday'] = $thismonday;
$_SESSION['saturday'] = $thissaturday;

$query = $conn->prepare('SELECT * FROM `class`WHERE instructor_id = :instructor_id AND date BETWEEN :startday AND :endday ORDER BY starthour ASC, date');
$query->execute(array(
    ':instructor_id' => $_SESSION['instructor_id'],
    ':startday' => $thismonday,
    ':endday' => $thissaturday
));

$r = $query->fetchAll(PDO::FETCH_ASSOC);
$x = array(
    'date' => "",
    'starthour' => "",
    'student_id' => ""
);
$r[] = $x;
?>
<div class="container-b container">
    <?php

    if (isset($_SESSION['succes'])) {
        echo '<div class="alert alert-success" role="alert">';
        echo '<strong>Success!</strong>';
        echo $_SESSION['succes'];
        echo '</div>';
        $_SESSION['succes'] = NULL;
    }
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger" role="alert">';
        echo '<strong>Oops!</strong>';
        echo $_SESSION['error'];
        echo '</div>';
        $_SESSION['error'] = NULL;
    }
    ?>
    <ul class="pager">
        <li class="previous"><a href="index.php?page=schedule&start=<?= $lastmonday ?>">Previous</a></li>
        <li class="this"><a href="index.php?page=schedule">Current Week</a></li>
        <li class="next"><a href="index.php?page=schedule&start=<?= $nextmonday ?>">Next</a></li>
    </ul>
    <table class="table">
        <thead class="thead-dark">
        <tr>
            <th scope="col">W: <?= $weeknumber ?></th>
            <th scope="col">Maandag</th>
            <th scope="col">Dinsdag</th>
            <th scope="col">Woensdag</th>
            <th scope="col">Donderdag</th>
            <th scope="col">Vrijdag</th>
            <th scope="col">Zaterdag</th>
        </tr>
        </thead>
        <tbody>
        <?php
        for ($j = $starthour; $j < 20; $j++) {
        ?>
        <tr>
            <th scope="row"><?= $j ?></th>
            <?php
            for ($i = 0; $i < 6; $i++) {
                ?>
                <td>
                    <label class="checkbox">
                        <?php
                        if ($r[$f]['starthour'] == $j && $r[$f]['date'] == date('Y-m-d', strtotime($startday . "+" . $i . " days"))) {
                            if ($r[$f]['student_id'] != NULL) {
                                $student = $conn->prepare('SELECT * FROM student  WHERE student_id= :student_id');
                                $student->execute(array(
                                    ':student_id' => $r[$f]['student_id']
                                ));
                                $sr = $student->fetch(PDO::FETCH_ASSOC);
                                ?>
                                <button type="button" class="btn btn-danger btn-width" data-toggle="modal" data-target="#studentinfo<?=$f?>"> Ingeplanned</button>

                                <div class="modal fade" id="studentinfo<?=$f?>" tabindex="-1" role="dialog"
                                     aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h3 class="modal-title modal-color" id="exampleModalLongTitle"><?= $sr['name']?> <?= $sr['surname']?></h3>
                                            </div>
                                            <div class="modal-body modal-color">
                                                <div class="container-modal">
                                                    <h5>Adress : <?= $sr['adress']?></h5>
                                                    <h5>Zip-Code : <?= $sr['zip-code']?></h5>
                                                    <h5>E-Mail : <?= $sr['email']?></h5>
                                                    <h5>Phone Number : <?= $sr['phone']?></h5>
                                                </div>
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            <?php } else { ?>
                                <button type="button" class="btn btn-success btn-width" disabled>Geen Les</button>
                                    <?php
                            }
                            $f++;
                            ?>
                        <?php } else { ?>
                            <button type="button" class="btn bl-gr btn-width" disabled>Niet Opgegeven</button>
                        <?php } ?>
                    </label>
                </td>
            <?php }
            } ?>
        </tr>
        </tbody>
    </table>
</div>
