<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printent - Login</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>

<style>
    .main_admin_login {
        display: flex;
        flex-direction: column;
        justify-content: center;
        align-items: center;
        background-color: ellow;
        height: 100vh;
        padding: 15px;
    }
</style>

<section class="bodyFont main_admin_login">
    <header class="Signup_header">
        <h1 class="Signup_logo">Printent</h1>
    </header>

    <div style="" class="Signup_login-container">
        <h2 class="Signup_h2">Login</h2>
        <p class="Signup_welcome-text">Hi, welcome back! 👋</p>
        <form id="login-form" class="Signup_login-form" method="POST" action="#">
            @csrf
            <label for="login-email">Email</label>
            <input type="email" id="login-email" name="email" value="{{ old('email') }}"
                placeholder="E.g. johndoe@email.com" required>
            {{-- @error('email')
                <div class="Signup_alert-danger">{{ $message }}
    </div>
    @enderror --}}
    <label for="login-password">Password</label>
    <input type="password" id="login-password" name="password" placeholder="Enter your password" required>
    <div id="error-password" class="New_Signup_alert-danger"></div>
    {{-- @error('password')
                <div class="Signup_alert-danger">{{ $message }}</div>
    @enderror --}}
    <button type="submit" class="Signup_login-button">Login</button>
    <div class="loader-overlay" id="loader-overlay"></div>

    <div class="loader-overlay" id="loader-overlay"></div>
    <div class="loader" id="loader"></div>
    <div id="login-errors" style="color: #721c24;margin-bottom: 10px;">
    </div>
    </form>

    <div class="Signup_signup-section">
        <!-- <p>Not registered yet? <a href="/signup" class="Signup_signup-link">Create an account</a></p> -->
    </div>
    </div>

    <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();
            document.getElementById('loader').style.display = 'block';
            document.getElementById('loader-overlay').style.display = 'block';
            const formData = new FormData(this);
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('https://smartprintsa.com/api/login', {
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
                    document.getElementById('error-password').innerText = '';
                    document.getElementById('login-errors').innerText = '';

                    // console.log(data);



                    if (data.token) {
                        // Check if the user role is admin (1)
                        if (data.user && data.user.role === 1) {
                            localStorage.setItem('admin-token', data.token);

                            // Show success message and redirect
                            const successMessage = document.createElement('div');
                            successMessage.innerText = 'Login successful! Redirecting to admin panel...';
                            document.getElementById('login-errors').appendChild(successMessage);

                            // Redirect to the admin/product page after a short delay
                            setTimeout(() => {
                                window.location.href = '/admin/product';
                            }, 700);

                        } else {
                            // If user is not admin, show a message
                            document.getElementById('login-errors').innerText = 'You are not admin, Unauthorized Access';
                            document.getElementById('loader').style.display = 'none';
                            document.getElementById('loader-overlay').style.display = 'none';
                        }

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
</section>

</html>