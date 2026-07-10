<!DOCTYPE html>
<html lang="en">
<head>

    <!-- Meta -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, minimum-scale=1, minimal-ui, viewport-fit=cover">
	<meta name="theme-color" content="#2196f3">
	<meta name="author" content="Rana Sharma">
    <meta name="keywords" content="">
    <meta name="robots" content="">
	<meta name="description" content="{{ env('APP_NAME') }}">
	<meta property="og:title" content="{{ env('APP_NAME') }}">
	<meta property="og:description" content="{{ env('APP_NAME') }}">
	<meta property="og:image" content="">
	<meta name="format-detection" content="telephone=no">

    <!-- Favicons Icon -->
	<link rel="shortcut icon" type="image/x-icon" href="assets/images/favicon.png">

    <!-- Title -->
	<title>Vivah Mitra Login | {{ env('APP_NAME') }}</title>

    <!-- Stylesheets -->
    <link rel="stylesheet" href="{{ static_asset('assets/assets_vivah_mitra/vendor/swiper/swiper-bundle.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ static_asset('assets/assets_vivah_mitra/css/style.css') }}">
    <!-- Sweetalerts JS -->
	<link rel="stylesheet" href="{{ static_asset('assets/assets_admin/libs/sweetalert2/sweetalert2.min.css') }}">
    <script src="{{ static_asset('assets/assets_admin/libs/sweetalert2/sweetalert2.min.js') }}"></script>
    <script src="{{ static_asset('assets/assets_admin/js/sweet-alerts.js') }}"></script>
    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin="">
    <link href="css2-2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Racing+Sans+One&display=swap" rel="stylesheet">

	<style>
	.page-content {
		min-height: 100vh;

		/* background image */
		background-image: url('{{ static_asset('assets/assets_vivah_mitra/images/login-background.png') }}');

		/* make it look premium */
		background-size: cover;        /* full screen */
		background-position: center;   /* center image */
		background-repeat: no-repeat;  /* no repeat */
		background-attachment: fixed;  /* smooth effect */

		/* optional overlay for better login form visibility */
		position: relative;
	}

	.page-content::before {
		content: "";
		position: absolute;
		inset: 0;
		background: rgba(0,0,0,0.45); /* dark overlay */
	}
	</style>
</head>
<body>
<div class="page-wraper">

    <!-- Preloader -->
	<div id="preloader">
		<div class="spinner"></div>
	</div>
    <!-- Preloader end-->

    <!-- Page Content -->
    <div class="page-content">

        <!-- Banner -->
        <div class="banner-wrapper shape-1">
            <div class="container inner-wrapper">
                <h2 class="dz-title">Log In</h2>
                <p class="mb-0">कृपया अपने विवाह मित्र खाते के डैशबोर्ड में साइन इन करें।</p>
            </div>
        </div>
        <!-- Banner End -->

        <div class="container">
			<div class="account-area">
				<form method="post" id="login-form" style="margin-top: 476px;" class="">
					@csrf
					<div style="display:none;" id="show-login-form-error" class="alert alert-danger col-md-12">
						<ul>
							<div class="errorMsgntainer"></div>
						</ul>
					</div>
					<div class="input-group">
						<input type="tel" name="username" placeholder="Your Mobile No." class="form-control">
					</div>
					<div class="input-group">
						<input type="password" name="password" placeholder="Password" id="dz-password" class="form-control be-0">
						<span class="input-group-text show-pass">
							<i class="fa fa-eye-slash"></i>
							<i class="fa fa-eye"></i>
						</span>
					</div>
                    {{-- <a href="javascript:void(0);" class="btn-link d-block text-center">Forgot your password?</a> --}}
					<div class="input-group">
						<button type="submit" class="btn mt-2 btn-primary w-100 btn-rounded login-button">Login</button>
					</div>
				</form>

                {{--<img src="{{ static_asset('assets/assets_vivah_mitra/images/welcome/welcome.png') }}" alt="{{ env('APP_NAME') }}" >

                 <div class="text-center p-tb20">
                    <span class="saprate">Or sign in with</span>
                </div> --}}
                {{--<div class="social-btn-group text-center">
                    <a href="https://www.google.com/" target="_blank" class="social-btn"><img src="assets/images/social/google.png" alt="socila-image"></a>
                    <a href="https://www.facebook.com/" target="_blank" class="social-btn ms-3"><img src="assets/images/social/facebook.png" alt="social-image"></a>
                </div>--}}
			</div>
		</div>
    </div>
    <!-- Page Content End -->

    <!-- Footer -->
    {{-- <footer class="footer fixed">
        <div class="container">
            <a href="javascript:void();" class="btn btn-primary light btn-rounded text-primary d-block">Create account</a>
        </div>
    </footer> --}}
    <!-- Footer End -->

    <!-- Theme Color Settings -->
	<div class="offcanvas offcanvas-bottom" tabindex="-1" id="offcanvasBottom">
        <div class="offcanvas-body small">
            <ul class="theme-color-settings">
                <li>
                    <input class="filled-in" id="primary_color_8" name="theme_color" type="radio" value="color-primary">
					<label for="primary_color_8"></label>
                    <span>Default</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_2" name="theme_color" type="radio" value="color-green">
					<label for="primary_color_2"></label>
                    <span>Green</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_3" name="theme_color" type="radio" value="color-blue">
					<label for="primary_color_3"></label>
                    <span>Blue</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_4" name="theme_color" type="radio" value="color-pink">
					<label for="primary_color_4"></label>
                    <span>Pink</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_5" name="theme_color" type="radio" value="color-yellow">
					<label for="primary_color_5"></label>
                    <span>Yellow</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_6" name="theme_color" type="radio" value="color-orange">
					<label for="primary_color_6"></label>
                    <span>Orange</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_7" name="theme_color" type="radio" value="color-purple">
					<label for="primary_color_7"></label>
                    <span>Purple</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_1" name="theme_color" type="radio" value="color-red">
					<label for="primary_color_1"></label>
                    <span>Red</span>
                </li>
                <li>
					<input class="filled-in" id="primary_color_9" name="theme_color" type="radio" value="color-lightblue">
					<label for="primary_color_9"></label>
                    <span>Lightblue</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_10" name="theme_color" type="radio" value="color-teal">
					<label for="primary_color_10"></label>
                    <span>Teal</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_11" name="theme_color" type="radio" value="color-lime">
					<label for="primary_color_11"></label>
                    <span>Lime</span>
                </li>
                <li>
                    <input class="filled-in" id="primary_color_12" name="theme_color" type="radio" value="color-deeporange">
					<label for="primary_color_12"></label>
                    <span>Deeporange</span>
                </li>
            </ul>
        </div>
    </div>
	<!-- Theme Color Settings End -->
</div>



<!-- end main-content -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
     document.addEventListener('DOMContentLoaded', function () {
    const loginForm = document.getElementById('login-form');
    const loginBtn = loginForm.querySelector('button');
    const errorContainer = document.querySelector('.errorMsgntainer');
    const alertBox = document.getElementById('show-login-form-error');

    loginForm.addEventListener('submit', function (e) {
        e.preventDefault(); // stop form from reloading page

        // Clear old messages
        errorContainer.innerHTML = '';
        alertBox.style.display = 'none';

        const formData = new FormData(loginForm);
        const data = Object.fromEntries(formData.entries());

        // Disable button while submitting
        loginBtn.disabled = true;
        loginBtn.textContent = 'Logging in...';

        fetch('{{ route("login.vivahMitraLoginPost") }}', {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('input[name="_token"]').value,
                'Accept': 'application/json'
            },
            body: formData
        })
        .then(async response => {
            const res = await response.json();
            if (response.ok) {
                // success
				Swal.fire({
					icon: "success",
					title: "Success",
					text: res.message || 'Login Successful!',
					timer: 1500,
					showConfirmButton: false
				});
                console.log(res.redirect_url);
                // redirect if route exists in response
                if (res.redirect_url) {
                    setTimeout(() => {
                        window.location.href = res.redirect_url;
                    }, 1000);
                } else {
                    // default redirect (adjust as needed)
                    setTimeout(() => {
                        window.location.href = '{{ url("") }}';
                    }, 1000);
                }
            } else {
                // show validation or server error
                if (res.errors) {
                    let errorsHtml = '';
                    for (const key in res.errors) {
                        errorsHtml += `<li>${res.errors[key][0]}</li>`;
                    }
                    errorContainer.innerHTML = errorsHtml;
                    alertBox.style.display = 'block';
                } else {
                    Swal.fire({
						icon: "error",
						title: "Error!",
						text: res.message ?? "Invalid credentials!",
						timer: 1500,
						showConfirmButton: false
					});
                }
            }
        })
        .catch(error => {
            console.error('Error:', error);
            toastr.error('Something went wrong, please try again!');
        })
        .finally(() => {
            loginBtn.disabled = false;
            loginBtn.textContent = 'Login';
        });
    });
});

</script>


<!--**********************************
    Scripts
***********************************-->
<script src="{{ static_asset('assets/assets_vivah_mitra/js/jquery.js') }}"></script>
<script src="{{ static_asset('assets/assets_vivah_mitra/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
<script src="{{ static_asset('assets/assets_vivah_mitra/js/settings.js') }}"></script>
<script src="{{ static_asset('assets/assets_vivah_mitra/js/custom.js') }}"></script>
</body>
</html>



