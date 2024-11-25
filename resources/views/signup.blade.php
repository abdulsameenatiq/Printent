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
            @include('components.signup.signup_component')
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
        document.getElementById('signup-form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('loader').style.display = 'block';
            document.getElementById('loader-overlay').style.display = 'block';
            const formData = new FormData();
            formData.append('name', document.getElementById('signup-name').value);
            formData.append('email', document.getElementById('signup-email').value);
            formData.append('password', document.getElementById('signup-password').value);
            formData.append('password_confirmation', document.getElementById('signup-confirm-password').value);

            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/api/register', {
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
                    // Clear previous errors
                    document.getElementById('loader').style.display = 'none';
                    document.getElementById('loader-overlay').style.display = 'none';
                    document.getElementById('error-name').innerText = '';
                    document.getElementById('error-email').innerText = '';
                    document.getElementById('error-password').innerText = '';
                    document.getElementById('error-password_confirmation').innerText = '';
                    document.getElementById('signup-errors').innerText = '';
                    // console.log(data);


                    if (data.email || data.password || data.name) {
                        // console.log("Errors", data);

                        if (data.name) {
                            document.getElementById('error-name').innerText = data.name[0];
                        }
                        if (data.email) {
                            document.getElementById('error-email').innerText = data.email[0];
                        }
                        if (data.password) {
                            document.getElementById('error-password').innerText = data.password[0];
                            if (data.password.length > 1) {
                                document.getElementById('error-password_confirmation').innerText = data
                                    .password[1];
                            }
                        }

                    } else if (data.message) {
                        // Success scenario
                        document.getElementById('signup-errors').innerText = data.message;

                        document.getElementById('signup-name').value = ""
                        document.getElementById('signup-email').value = ""
                        document.getElementById('signup-password').value = ""
                        document.getElementById('signup-confirm-password').value = ""

                        window.alert(data.message)

                        // Redirect after success
                        // setTimeout(() => {
                        //     window.location.href = '/login';
                        // }, 1000);
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