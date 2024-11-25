@extends('components.layout.layout')

@section('title', 'Smart')
@section('meta_description', 'Smart')
@section('meta_keywords', 'Smart')

@section('content')

<body>
    <div class="page">
        <div class="">
            @include('components.home.navbar')
        </div>

        <div class="site-main">
            @include('components.login.login_component')

        </div>

        @include('components.home.footer')


        <!-- back-to-top start -->
        <a id="totop" href="#top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- back-to-top end -->

    </div>

    <!-- Javascript -->
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery-validate.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery-waypoints.js"></script>
    <script src="js/numinate.min.js"></script>
    <script src="js/imagesloaded.min.js"></script>
    <script src="js/jquery-isotope.js"></script>
    <script src="js/jquery.twentytwenty.js"></script>
    <script src="js/circle-progress.min.js"></script>
    <script src="js/main.js"></script>

    <!-- Revolution Slider -->
    <script src='revolution/js/revolution.tools.min.js'></script>
    <script src='revolution/js/rs6.min.js'></script>
    <script src="revolution/js/slider.js"></script>
    <!-- Javascript end-->

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            console.log("TEsting '''''''''''''''''''''''''");

            document.getElementById('loader').style.display = 'block';
            document.getElementById('loader-overlay').style.display = 'block';
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/api/login', {
                    method: 'POST',
                    body: formData,
                    headers: {
                        'Accept': 'application/json',
                        'X-Requested-With': 'XMLHttpRequest',
                        'X-CSRF-TOKEN': csrfToken
                    }
                })
                .then(response => response.json())
                .then(data => {
                    document.getElementById('loader').style.display = 'none';
                    document.getElementById('loader-overlay').style.display = 'none';
                    document.getElementById('error-password').innerText = '';
                    document.getElementById('login-errors').innerText = '';

                    console.log(data);

                    if (data.token) {
                        localStorage.setItem('jwt_token', data.token);
                        localStorage.setItem("user_details", JSON.stringify(data.user));


                        const successMessage = document.createElement('div');
                        // successMessage.className = 'Signup_alert-success';
                        // successMessage.innerText = "Success";
                        document.getElementById('login-errors').appendChild(successMessage);

                        // Redirect to the homepage after a short delay
                        setTimeout(() => {
                            document.getElementById('login-errors').removeChild(successMessage);
                            window.location.href = '/';
                        }, 700);

                    } else if (data.error) {
                        document.getElementById('login-errors').innerText = data.error;
                    }
                    if (data.errors.password) {
                        document.getElementById('error-password').innerText = data.errors.password[0];
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    document.getElementById('loader').style.display = 'none';
                    document.getElementById('loader-overlay').style.display = 'none';
                });
        });
    </script>
</body>
@endsection