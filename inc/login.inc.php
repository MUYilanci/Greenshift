<?php

if (isset($_SESSION['error'])) {
    echo '<div class="alert alert-danger" role="alert">';
    echo $_SESSION['error'];
    echo '</div>';
    $_SESSION['error'] = NULL;
}
?>

<div class="limiter">
    <div class="container-login100">
        <div class="wrap-login100">
            <div class="login100-pic js-tilt" data-tilt>
                <img src="img/img-01.png" alt="IMG">
            </div>
            <form class="login100-form validate-form" method='POST' action='php/login.php'>
					<span class="login100-form-title">
						Member Login
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

                <div class="container-login100-form-btn">
                    <button type="submit" name="submit" class="login100-form-btn">
                        Login
                    </button>
                </div>

                <div class="text-center p-t-12">
						<span class="txt1">
							New?
						</span>
                    <a class="txt2" href="index.php?page=register">
                        Register Here!
                    </a>
                </div>
                <div class="text-center p-t-136"></div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.js-tilt').tilt({
        scale: 1.1
    })
</script>

