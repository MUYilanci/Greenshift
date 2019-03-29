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
    <?php if (isset($_SESSION['succes'])) {
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
    <h1>Planner</h1>
    <ul class="pager">
        <li class="previous"><a href="index.php?page=inplannen&start=<?= $lastmonday ?>">Previous</a></li>
        <li class="this"><a href="index.php?page=inplannen">Current Week</a></li>
        <li class="this"><a href="index.php?page=inplannen&start=<?= $lastmonday ?>">Copy Last Week</a></li>
        <li class="next"><a href="index.php?page=inplannen&start=<?= $nextmonday ?>">Next</a></li>
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
                <th scope="row"><?= $j?></th>
                <?php

                for ($i = 0; $i < 6; $i++) {
                    ?>
                    <td>
                        <label class="checkbox">

                            <?php
                            if ($r[$f]['starthour'] == $j && $r[$f]['date'] == date('Y-m-d', strtotime($startday . "+" . $i . " days"))) {
                                if ($r[$f]['student_id'] == NULL){?>
                                <form method="POST" action="php/inplannen.php">
                                    <input type="hidden" name="time[]" value="<?= $j ?> <?= $datum = date('Y-m-d', strtotime($startday . "+" . $i . " days"))?>" id="defaultCheck1">
                                    <button type="submitx" class="btn btn-success btn-width">Beschikbaar </button>
                                </form>
                                <?php  }
                                elseif ($r[$f]['student_id'] == $_SESSION['student_id']){
                                    echo '<button type="button" class="btn btn-primary btn-width" disabled >Ingeplanned</button>';
                                }
                                else{
                                    echo '<button type="button" class="btn btn-danger btn-width" disabled >Gereserveerd</button>';
                                }
                                $f++;
                                ?>
                            <?php } else { ?>
                                <button type="button" class="btn bl-gr btn-width" disabled>Geen Lessen</button>
                            <?php } ?>
                        </label>
                    </td>
                <?php }
                } ?>
            </tr>
            </tbody>
        </table>
</div>