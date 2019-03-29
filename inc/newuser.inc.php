<div class="container-login50">
    <div class="wrap-login50">
        <?php

        if (isset($_SESSION['error'])) {
            echo '<div class="alert alert-danger" role="alert">';
            echo $_SESSION['error'];
            echo '</div>';

            $_SESSION['error'] = NULL;
        }

        if (isset($_SESSION['register'])) {
            echo '<div class="container">';
            echo '<div class="alert alert-primary" role="alert">';
            echo $_SESSION['register'];
            echo '</div>';
            echo '</div>';

            $_SESSION['register'] = NULL;
        }

        ?>
        <form class="login100-form validate-form" method='POST' action='php/register.php'>
					<span class="login100-form-title">
						New user
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

            <div class="wrap-input100 validate-input" data-validate="Role is required" style="color: gray">
                <input type="radio" name="role" value="admin"> Admin<br>
                <input type="radio" name="role" value="referee"> Referee<br>
            </div>

            <div class="container-login100-form-btn">
                <button type="submit" name="submit" class="login100-form-btn">
                    Add new user
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
