<?php
include "php/dbh.php";
$_SESSION['instructor_id'] = $_POST['instructor_id'];

$query1 = $conn->prepare('SELECT * FROM `instructor` WHERE instructor_id = :instructor_id');
$query1->execute(
    [
        "instructor_id" => $_SESSION['instructor_id']
    ]
);

$data = $query1->fetch();
?>
<div class="container-login50">
    <div class="wrap-login50">

        <form class="login100-form validate-form" method='POST' action='php/userchange.php'>
					<span class="login100-form-title">
						Update Instructor
					</span>

            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <input class="input100" type="text" name="name" value="<?= $data['name']?>">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Surname is required">
                <input class="input100" type="text" name="surname" value="<?= $data['surname']?>">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Email is required">
                <input class="input100" type="text" name="email" value="<?= $data['email']?>">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Phonenumber is required">
                <input class="input100" type="text" name="phone" value="<?= $data['phone']?>">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Hours is required">
                <input class="input100" type="text" name="hours" value="<?= $data['hours']?>">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="container-login100-form-btn">
                <button type="submit" name="submit" class="login100-form-btn">
                    Update Now!
                </button>
            </div>

        </form>
    </div>
</div>

<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>

