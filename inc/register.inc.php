<?php
include 'php/dbh.php';

$stm = $conn->prepare("SELECT * FROM instructor");
$stm->execute();

$results = $stm->fetchAll(PDO::FETCH_ASSOC);
?>
<div class="container-login50">
    <div class="wrap-login50">

        <form class="login100-form validate-form" method='POST' action='php/register.php'>
					<span class="login100-form-title">
						Your Information
					</span>

            <div class="wrap-input100 validate-input" data-validate="Username is required">
                <input class="input100" type="text" name="username" placeholder="Username">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <input class="input100" type="password" name="password" placeholder="Password">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <input class="input100" type="password" name="repeat_password" placeholder="Repeat password">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
            </div>

            <hr>

            <div class="wrap-input100 validate-input" data-validate="Name is required">
                <input class="input100" type="text" name="name" placeholder="Name">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Surname is required">
                <input class="input100" type="text" name="surname" placeholder="Surname">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Adress is required">
                <input class="input100" type="text" name="adress" placeholder="Adress">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Zip-code is required">
                <input class="input100" type="text" name="zipcode" placeholder="Zip-code">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Email is required">
                <input class="input100" type="text" name="email" placeholder="Email">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Phonenumber is required">
                <input class="input100" type="text" name="phone" placeholder="Phonenumber">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="col-md-12">
                <div class="ui-select">
                    <select name="instructor_id" class="form-control">
                        <?php
                        $count = count($results) - 1;
                        for ($i = 0; $i <= $count; $i++) {
                            ?>
                            <option selected disabled hidden>kies...</option>
                            <option value="<?= $results[$i]["instructor_id"] ?>"><?= $results[$i]["name"]?> <?= $results[$i]["surname"]?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
            <br>

            <div class="container-login100-form-btn">
                <button type="submit" name="submit" class="login100-form-btn">
                    Register Now!
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
