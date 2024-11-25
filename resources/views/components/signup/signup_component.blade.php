<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Printent - Signup</title>
    <link rel="stylesheet" type="text/css" href="css/main.css">
    <meta name="csrf-token" content="{{ csrf_token() }}">
</head>


<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_sign_up($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<style>
    .main_signup_body {
        display: flex;
        justify-content: center;
        align-items: center;
        /* background-color: grey; */
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
<section style="background-color: rd;" class="bodyFont main_signup_body">



    <div style="background-color: gren; margin-bottom: 30px; direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
        class="Signup_signup-container">
        <h2 class="Signup_h2">
            <?php echo translate('sign_up_heading', $lang, $translations); ?>

        </h2>

        <form id="signup-form" class="Signup_signup-form" method="POST">
            @csrf
            <label for="signup-name">
                <?php echo translate('sign_up_name', $lang, $translations); ?>

            </label>
            <input type="text" id="signup-name" name="name"
                placeholder="<?php echo translate('sign_up_name_palce_holder', $lang, $translations); ?>" required>
            <div id="error-name" class="New_Signup_alert-danger"></div>

            <label for="signup-email">
                <?php echo translate('sign_up_email', $lang, $translations); ?>

            </label>
            <input type="email" id="signup-email" name="email"
                placeholder=" <?php echo translate('sign_up_email_place_holder', $lang, $translations); ?> " required>
            <div id="error-email" class="New_Signup_alert-danger"></div>

            <label for="signup-password">
                <?php echo translate('sign_up_passwword', $lang, $translations); ?>
            </label>
            <div class="password-container">
                <input type="password" id="signup-password" name="password"
                    placeholder="<?php echo translate('sign_up_passwword_place_holder', $lang, $translations); ?>"
                    required>
                <span toggle="#signup-password" class="toggle-password fa fa-eye-slash fa-fw field_icon"></span>
            </div>
            <div id="error-password" class="New_Signup_alert-danger"></div>


            <label for="signup-confirm-password">
                <?php echo translate('sign_up_confirm', $lang, $translations); ?>
            </label>
            <div class="password-container">
                <input type="password" id="signup-confirm-password" name="password_confirmation"
                    placeholder=" <?php echo translate('sign_up_confirm_place_holder', $lang, $translations); ?> "
                    required>
                <span toggle="#signup-confirm-password" class="toggle-confirm-password fa fa-eye-slash fa-fw field_icon"></span>
            </div>
            <div id="error-password_confirmation" class="New_Signup_alert-danger"></div>

            <button type="submit" class="Signup_signup-button">
                <?php echo translate('sign_up_btn', $lang, $translations); ?>
            </button>


            <div class="loader-overlay" id="loader-overlay"></div>
            <div class="loader" id="loader"></div>
            <div id="signup-errors" style="color: #721c24;margin-bottom: 10px;">
            </div>
        </form>

        <div class="Signup_signup-section">
            <p>
                <?php echo translate('sign_up_already', $lang, $translations); ?>
                <a href="/login" class="Signup_signup-link">
                    <?php echo translate('sign_up_login_btn', $lang, $translations); ?>
                </a>
            </p>
        </div>
    </div>

    <script>
        // password signup
        document.querySelector('.toggle-password').addEventListener('click', function (e) {
            let passwordInput = document.querySelector('#signup-password');
            const type = passwordInput.getAttribute('type') === 'text' ? 'password' : 'text';
            passwordInput.setAttribute('type', type);

            // Toggle the eye/eye-slash icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });

        // confirm password signup
        document.querySelector('.toggle-confirm-password').addEventListener('click', function (e) {
            let passwordInput = document.querySelector('#signup-confirm-password');
            const type = passwordInput.getAttribute('type') === 'text' ? 'password' : 'text';
            passwordInput.setAttribute('type', type);

            // Toggle the eye/eye-slash icon
            this.classList.toggle('fa-eye');
            this.classList.toggle('fa-eye-slash');
        });
    </script>
    <!-- <script>
        document.getElementById('signup-form').addEventListener('submit', function(e) {
            e.preventDefault();

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
                });
        });
    </script> -->
</section>

</html>