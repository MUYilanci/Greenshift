<div class="container" style="">
    <?php
    if (isset($_SESSION['error'])) {
        echo '<div class="alert alert-danger" role="alert">';
        echo $_SESSION['error'];
        echo '</div>';
        $_SESSION['error'] = NULL;
    }
    $nextmondaytime = (strtotime('next Monday', strtotime('tomorrow')));
    $nextmonday = date('y/m/d', $nextmondaytime);
    ?>
    <form method="POST" action="php/test.php">
        <table class="table">
            <thead class="thead-dark">
            <tr>
                <th scope="col">-</th>
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
            $starthour = 8;
            for ($j = $starthour; $j < 20 ;$j++) {
            ?>
            <tr>
                <th scope="row"><?= $j ?></th>
                <?php
                $startday = $nextmonday;
                for ($i = 0; $i < 6; $i++) {
                    ?>
                    <td>
                        <label class="checkbox">
                            <input type="checkbox" name="time[]" type="checkbox"
                                   value="<?= $j ?> <?= date('Y-m-d', strtotime($startday . "+" . $i . " days")) ?>"
                                   id="defaultCheck1">
                            <span></span>
                        </label>
                    </td>
                <?php }
                } ?>
            </tr>
            </tbody>
        </table>
        <input type="submit" name="nextweek" value="Plan" class="btn btn-primary float-r" />
        <input type="submit" name="lastweek" value="Previous" class="btn btn-primary margin-r float-r"/>
    </form>
</div>