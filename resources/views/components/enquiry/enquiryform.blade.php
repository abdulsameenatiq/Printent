<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

if (file_exists('./translations.json')) {
    $translations_json = file_get_contents('./translations.json');
    $translations = json_decode($translations_json, true);
} else {
    $translations = [];
}

if (!function_exists('translate')) {
    function translate_enquiry($key, $lang, $translations)
    {
        return isset($translations[$lang][$key]) ? $translations[$lang][$key] : ($translations['en'][$key] ?? $key);
    }
}
?>

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo translate('Direct Order', $lang, $translations); ?></title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <style>
        .error {
            border: 1px solid red;
        }

        .success {
            color: green;
            display: none;
        }

        .error-message {
            color: red;
            font-size: 0.9em;
        }

        .drag-over {
            border: 2px dashed #aaa;
        }
    </style>
</head>

<body>

    <section
        style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
        class="main_enquiry">
        <div class="nav_fix_margin"></div>
        <h5 class="main_enquiry_heading"><?php echo translate('Direct Order', $lang, $translations); ?></h5>

        <div class="main_enquiry_form">
            <div class="main-enquiry_three_input">
                <div class="main_enqury_input">
                    <label for="fullName"><?php echo translate('Full Name', $lang, $translations); ?> <span
                            class="main_enqury_input_required">*</span></label>
                    <input type="text" id="fullName" required>
                    <small id="nameError" class="error-message"></small>
                </div>

                <div class="main_enqury_input">
                    <label for="email"><?php echo translate('Email', $lang, $translations); ?> <span
                            class="main_enqury_input_required">*</span></label>
                    <input type="text" id="email" required>
                    <small id="emailError" class="error-message"></small>
                </div>

                <div class="main_enqury_input main_enqury_input_3">
                    <label for="mobileNo"><?php echo translate('Mobile No', $lang, $translations); ?> <span
                            class="main_enqury_input_required">*</span></label>
                    <input type="text" id="mobileNo" pattern="\d{11}" required>
                    <small id="mobileError" class="error-message"></small>
                </div>
            </div>

            <div class="main_enqury_input">
                <label for="message"><?php echo translate('Message', $lang, $translations); ?> <span
                        class="main_enqury_input_required">*</span></label>
                <textarea id="message" rows="4" cols="50" required></textarea>
                <small id="messageError" class="error-message"></small>
            </div>

            <div class="main_enqury_file">
                <label for="fileInput"><?php echo translate('Attach File', $lang, $translations); ?></label>
                <div class="main_enqury_file_box" id="file-drop-area">
                    <input type="file" id="fileInput" hidden required>
                    <i class="main_enqury_fileicon fa fa-cloud-upload"></i>
                    <h6><?php echo translate('Drag and drop a file here / click the icon', $lang, $translations); ?>
                    </h6>
                </div>
                <div id="fileDetails" class="file-details"></div>
                <small id="fileError" class="error-message"></small>
            </div>

            <div class="main_enqury_btn-div">
                <button id="submitBtn"><?php echo translate('Send Request', $lang, $translations); ?></button>
            </div>
            <div id="formSuccess" class="success"></div>
        </div>
    </section>

    <script>
        // JavaScript for file upload and validation
        const dropArea = document.getElementById('file-drop-area');
        const fileInput = document.getElementById('fileInput');
        const fileDetails = document.getElementById('fileDetails');
        const uploadIcon = document.querySelector('.main_enqury_fileicon');

        uploadIcon.addEventListener('click', (event) => {
            event.stopPropagation();
            fileInput.click();
        });

        fileInput.addEventListener('change', (event) => {
            handleFiles(event.target.files);
        });

        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('drag-over');
        });

        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('drag-over');
        });

        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('drag-over');
            const files = event.dataTransfer.files;
            handleFiles(files);
        });

        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                fileDetails.innerHTML = `Selected File: <b>${file.name}</b> (${(file.size / 1024).toFixed(2)} KB)`;
            }
        }

        const fullName = document.getElementById('fullName');
        const email = document.getElementById('email');
        const mobileNo = document.getElementById('mobileNo');
        const message = document.getElementById('message');
        const submitBtn = document.getElementById('submitBtn');
        const formSuccess = document.getElementById('formSuccess');

        fullName.addEventListener('input', validateFullName);
        email.addEventListener('input', validateEmail);
        mobileNo.addEventListener('input', validateMobile);
        message.addEventListener('input', validateMessage);

        submitBtn.addEventListener('click', (event) => {
            event.preventDefault();

            if (validateForm()) {
                const formData = new FormData();
                formData.append("name", fullName.value);
                formData.append("email", email.value);
                formData.append("mobile", mobileNo.value);
                formData.append("message", message.value);

                if (fileInput.files.length > 0) {
                    formData.append("images[]", fileInput.files[0]);
                }

                async function submitForm() {
                    try {
                        const response = await fetch('https://smartprintsa.com/api/quote', {
                            method: "POST",
                            body: formData
                        });

                        const data = await response.json();

                        if (response.ok) {
                            formSuccess.innerText = '<?php echo translate('Form submitted successfully!', $lang, $translations); ?>';
                            formSuccess.style.display = 'block';
                            clearForm();
                        } else {
                            formSuccess.innerText = '<?php echo translate('Failed to submit the form. Please try again.', $lang, $translations); ?>';
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        formSuccess.innerText = '<?php echo translate('An error occurred. Please try again later.', $lang, $translations); ?>';
                    }
                }

                submitForm();
            } else {
                formSuccess.innerText = '';
            }
        });

        function validateForm() {
            let valid = true;
            if (!validateFullName()) valid = false;
            if (!validateEmail()) valid = false;
            if (!validateMobile()) valid = false;
            if (!validateMessage()) valid = false;
            if (!validateFile()) valid = false;
            return valid;
        }

        function validateFile() {
            const fileError = document.getElementById('fileError');
            if (fileInput.files.length === 0) {
                fileError.innerText = "<?php echo translate('File is required', $lang, $translations); ?>";
                fileInput.classList.add('error');
                return false;
            } else {
                fileError.innerText = "";
                fileInput.classList.remove('error');
                return true;
            }
        }

        function validateFullName() {
            const nameError = document.getElementById('nameError');
            if (fullName.value.trim() === "") {
                nameError.innerText = "<?php echo translate('Full Name is required', $lang, $translations); ?>";
                fullName.classList.add('error');
                return false;
            } else {
                nameError.innerText = "";
                fullName.classList.remove('error');
                return true;
            }
        }

        function validateEmail() {
            const emailError = document.getElementById('emailError');
            const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
            if (email.value.trim() === "") {
                emailError.innerText = "<?php echo translate('Email is required', $lang, $translations); ?>";
                email.classList.add('error');
                return false;
            } else if (!emailPattern.test(email.value)) {
                emailError.innerText = "<?php echo translate('invalid_email', $lang, $translations); ?>";
                email.classList.add('error');
                return false;
            } else {
                emailError.innerText = "";
                email.classList.remove('error');
                return true;
            }
        }

        function validateMobile() {
            const mobileError = document.getElementById('mobileError');
            const mobilePattern = /^\d{11}$/;
            if (mobileNo.value.trim() === "") {
                mobileError.innerText = "<?php echo translate('Mobile number is required', $lang, $translations); ?>";
                mobileNo.classList.add('error');
                return false;
            } else if (!mobilePattern.test(mobileNo.value)) {
                mobileError.innerText = "<?php echo translate('Mobile number must be 11 digits', $lang, $translations); ?>";
                mobileNo.classList.add('error');
                return false;
            } else {
                mobileError.innerText = "";
                mobileNo.classList.remove('error');
                return true;
            }
        }

        function validateMessage() {
            const messageError = document.getElementById('messageError');
            if (message.value.trim() === "") {
                messageError.innerText = "<?php echo translate('Message is required', $lang, $translations); ?>";
                message.classList.add('error');
                return false;
            } else {
                messageError.innerText = "";
                message.classList.remove('error');
                return true;
            }
        }

        function clearForm() {
            fullName.value = '';
            email.value = '';
            mobileNo.value = '';
            message.value = '';
            fileInput.value = '';
            fileDetails.innerHTML = '';
            document.querySelectorAll('.error-message').forEach(el => el.innerText = '');
            document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));
        }
    </script>
</body>

</html>