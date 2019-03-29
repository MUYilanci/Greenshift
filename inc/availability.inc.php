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

if (isset($_GET['copy'])){
    $query = $conn->prepare('SELECT * FROM `class`WHERE instructor_id = :instructor_id AND date BETWEEN :startday AND :endday ORDER BY starthour ASC, date');
    $query->execute(array(
        ':instructor_id' => $_SESSION['instructor_id'],
        ':startday' => $lastmonday,
        ':endday' => $lastsaturday
    ));
    $r = $query->fetchAll(PDO::FETCH_ASSOC);
}
else{
    $query = $conn->prepare('SELECT * FROM `class`WHERE instructor_id = :instructor_id AND date BETWEEN :startday AND :endday ORDER BY starthour ASC, date');
    $query->execute(array(
        ':instructor_id' => $_SESSION['instructor_id'],
        ':startday' => $thismonday,
        ':endday' => $thissaturday
    ));
    $r = $query->fetchAll(PDO::FETCH_ASSOC);
}

$x = array(
    'date' => "",
    'starthour' => "",
    'student_id' => ""
);
$r[] = $x;

?>
<div class="container container-b">
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
    <ul class="pager">
        <li class="previous"><a href="index.php?page=availability&start=<?= $lastmonday ?>">Previous</a></li>
        <li class="this"><a href="index.php?page=availability">Current Week</a></li>
        <li class="this"><a href="index.php?page=availability&start=<?= $thismonday ?>&copy=true">Copy Last Week</a></li>
        <li class="next"><a href="index.php?page=availability&start=<?= $nextmonday ?>">Next</a></li>
    </ul>
    <form method="POST" action="php/availability.php">
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
                            if (isset($_GET['copy'])){
                            if ($r[$f]['starthour'] == $j && $r[$f]['date'] == date('Y-m-d', strtotime($lastmonday . "+" . $i . " days"))) {
                            ?>
                                    <input type="checkbox" name="time[]"
                                           value="<?= $j ?> <?= $datum = date('Y-m-d', strtotime($startday . "+" . $i . " days")) ?>"
                                           id="defaultCheck1" checked>
                                <?php
                                $f++;
                            } else { ?>
                                <input type="checkbox" name="time[]"
                                       value="<?= $j ?> <?= $datum = date('Y-m-d', strtotime($startday . "+" . $i . " days")) ?>"
                                       id="defaultCheck1">
                            <?php } }
                            else {
                                if ($r[$f]['starthour'] == $j && $r[$f]['date'] == date('Y-m-d', strtotime($startday . "+" . $i . " days"))) {
                                    if ($r[$f]['student_id'] != NULL) { ?>
                                        <input type="checkbox" name="time[]"
                                               value="<?= $j ?> <?= $datum = date('Y-m-d', strtotime($startday . "+" . $i . " days")) ?>"
                                               id="defaultCheck1" checked disabled>
                                        <?php
                                    } else { ?>
                                        <input type="checkbox" name="time[]"
                                               value="<?= $j ?> <?= $datum = date('Y-m-d', strtotime($startday . "+" . $i . " days")) ?>"
                                               id="defaultCheck1" checked>
                                    <?php }
                                    $f++;
                                } else { ?>
                                    <input type="checkbox" name="time[]"
                                           value="<?= $j ?> <?= $datum = date('Y-m-d', strtotime($startday . "+" . $i . " days")) ?>"
                                           id="defaultCheck1">
                                <?php } }?>
                            <span></span>
                        </label>
                    </td>
                <?php }
                } ?>
            </tr>
            </tbody>
        </table>
        <button type="submit" class="btn btn-success btn-lg btn-block">Plan!</button>
    </form>
</div>