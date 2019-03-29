<div class="container-login50">
    <div class="wrap-login50">

        <form class="login100-form validate-form" method='POST' action='php/newpackage.php'>
					<span class="login100-form-title">
						New Package
					</span>

            <div class="wrap-input100 validate-input" data-validate="Username is required">
                <input class="input100" type="text" name="class" placeholder="Lessons">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-envelope" aria-hidden="true"></i>
						</span>
            </div>

            <div class="wrap-input100 validate-input" data-validate="Password is required">
                <input class="input100" type="text" name="price" placeholder="Price">
                <span class="focus-input100"></span>
                <span class="symbol-input100">
							<i class="fa fa-lock" aria-hidden="true"></i>
						</span>
            </div>

            <div class="form-check">
                <input class="form-check-input" type="radio" name="active" id="exampleRadios1" value="1" checked>
                <label class="form-check-label text-black" for="exampleRadios1">
                    Active
                </label>
            </div>
            <div class="form-check">
                <input class="form-check-input" type="radio" name="active" id="exampleRadios2" value="0">
                <label class="form-check-label text-black" for="exampleRadios2">
                    Inactive
                </label>
            </div>

            <br>

            <div class="container-login100-form-btn">
                <button type="submit" name="submit" class="login100-form-btn">
                    Add Now!
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
