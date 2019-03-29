<?php
include "php/dbh.php";

$st4 = "SELECT * FROM `instructor`";
$query = $conn->query($st4);
?>
<div class="container-b container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-5">
                    <h2>User <b>Management</b></h2>
                </div>
            <div class="col-sm-7">
                <button type="button" class="btn btn-secondary right"><a href="index.php?page=newinstructor" class="button1">Add Instructor</a></button>
            </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Name</th>
                <th>E-mail</th>
                <th>Hours</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($data = $query->fetch()):
                ?>
                <tr>
                    <td> <?= $data['instructor_id'] ?></td>
                    <td><?= $data['name']; ?> <?= $data['surname'] ?></td>
                    <td><?= $data['email'] ?></td>
                    <td><?= $data['hours'] ?></td>
                    <td>
                        <form action='index.php?page=userchange' method='post'>
                            <input type="hidden" name="instructor_id" value="<?= $data['instructor_id'] ?>">
                            <button class="button1 settings" href="index.php?page=userchange" title="Settings"
                                    data-toggle="tooltip"><i class="material-icons">&#xE8B8;</i></button>
                        </form>
                    </td>
                    <td>
                        <form action='php/deleteuser.php' method='post'>
                            <input type="hidden" name="instructor_id" value="<?= $data['instructor_id'] ?>">
                            <button class="button1 delete" title="Delete" data-toggle="tooltip"><i
                                        class="material-icons">&#xE5C9;</i></button>
                        </form>
                    </td>
                </tr>
            <?php
            endwhile;
            ?>
            </tbody>
        </table>

    </div>
</div>
