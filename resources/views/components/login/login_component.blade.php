<!-- <!DOCTYPE html>
<html lang="en"> -->

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printent - Login</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_login($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<style>
    .main_signup_body {
        display: flex;
        justify-content: center;
        align-items: center;
        padding-left: 15px;
        padding-right: 15px;
        margin-top: 180px;
    }

    @media (max-width: 1198px) {
        .main_signup_body {
            margin-top: 20px;
        }
    }

        /* Password container to position the eye icon */
        .password-container {
        position: relative;
        width: 100%;
        /* Adjust according to your form design */
    }

    /* Style for the password input */
    .password-container input[type="password"],
    .password-container input[type="text"] {
        width: 100%;
        padding: 10px;
        padding-right: 40px;
        /* Add space for the eye icon */
        border: 1px solid #ccc;
        border-radius: 4px;
        box-sizing: border-box;
    }

    /* Style for the eye icon */
    .field_icon {
        position: absolute;
        top: 50%;
        right: 10px;
        transform: translateY(-50%);
        cursor: pointer;
        color: #999;
        /* Default icon color */
    }

    /* Hover effect for the icon */
    .field_icon:hover {
        color: #333;
    }
</style>

<!-- <div class="signup_fix_margin"></div> -->
<section class="bodyFont main_signup_body">
    <!-- <header class="Signupeader" style="margin-top: 120px;">
        <h1 class="Signup_logo">Printent</h1>
    </header> -->

    <!-- signn up card -->

    <div style="background-color: geen; margin-bottom: 30px; direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
        class="Signup_login-container">
        <h2 class="Signup_h2">
            <?php echo translate('login_heading', $lang, $translations); ?>

        </h2>
        <p class="Signup_welcome-text">
            <?php echo translate('login_welcome', $lang, $translations); ?>

        </p>
        <form id="login-form" class="Signup_login-form" method="POST" action="#">
            @csrf
            <label for="login-email">
                <?php echo translate('login_email', $lang, $translations); ?>

            </label>
            <input type="email" id="login-email" name="email" value="{{ old('email') }}"
                placeholder=" <?php echo translate('login_email_place_order', $lang, $translations); ?>  " required>
            {{-- @error('email')
            <div class="Signup_alert-danger">{{ $message }}
            </div>
            @enderror --}}
            <label for="login-password">
                <?php echo translate('login_password', $lang, $translations); ?>
            </label>
            <div class="password-container">
                <input type="password" id="login-password" name="password"
                    placeholder="<?php echo translate('login_password_place_order', $lang, $translations); ?>" required>
                <span toggle="#login-password" class="toggle-password fa fa-eye-slash fa-fw field_icon"></span>
            </div>
            <div id="error-password" class="New_Signup_alert-danger"></div>
            {{-- @error('password')
            <div class="Signup_alert-danger">{{ $message }}</div>
            @enderror --}}
            <button type="submit" class="Signup_login-button">
                <?php echo translate('login_btn', $lang, $translations); ?>
            </button>

            <div class="loader-overlay" id="loader-overlay"></div>
            <div class="loader" id="loader"></div>
            <div id="login-errors" style="color: #721c24;margin-bottom: 10px;">
            </div>
        </form>

        <div class="Signup_signup-section">
            <p>
                <?php echo translate('login_register', $lang, $translations); ?>
                <a href="/signup" class="Signup_signup-link">
                    <?php echo translate('login_create', $lang, $translations); ?>
                </a>
            </p>
        </div>
    </div>
<script>
    // logiN password

    document.querySelector('.toggle-password').addEventListener('click', function (e) {
            let passwordInput = document.querySelector('#login-password');
            const type = passwordInput.getAttribute('type') === 'text' ? 'password' : 'text';
            passwordInput.setAttribute('type', type);

            // Toggle the eye/eye-slash icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
</script>


    <!-- <script>
        document.getElementById('login-form').addEventListener('submit', function(e) {
            e.preventDefault();

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
                    document.getElementById('error-password').innerText = '';
                    document.getElementById('login-errors').innerText = '';

                    console.log(data);


                    if (data.token) {
                        localStorage.setItem('jwt_token', data.token);
                        localStorage.setItem("user_details", JSON.stringify(data.user));


                        const successMessage = document.createElement('div');
                        successMessage.className = 'Signup_alert-success';
                        successMessage.innerText = data.success_message;
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
                });
        });
    </script> -->
</section>

<!-- </html> -->