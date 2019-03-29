<?php
include "php/dbh.php";

$st4 = "SELECT * FROM `packages`";
$query = $conn->query($st4);
?>
<div class="container-b container">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-5">
                    <h2>Package <b>Management</b></h2>
                </div>
                <div class="col-sm-7">
                    <button type="button" class="btn btn-secondary right"><a href="index.php?page=newpackage" class="button1 text-white">New Package</a></button>
                </div>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
            <tr>
                <th>#</th>
                <th>Lessons</th>
                <th>Price</th>
                <th>Active</th>
                <th>Delete</th>
            </tr>
            </thead>
            <tbody>
            <?php
            while ($data = $query->fetch()):
                ?>
                <tr>
                    <td> <?= $data['packages_id'] ?></td>
                    <td><?= $data['classes'] ?></td>
                    <td><?= $data['price'] ?></td>
                    <?php if ($data['active'] == 1) { ?>
                        <td>
                            <span class="status text-success">&bull;</span><a class="text-white" href="php/switchpackage.php?id=<?= $data['packages_id']?>">Active</a>
                        </td>
                    <?php } else { ?>
                        <td>
                            <span class="status text-danger">&bull;</span><a class="text-white" href="php/switchpackage.php?id=<?= $data['packages_id']?>">Inactive</a>
                        </td>
                    <?php } ?>
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
