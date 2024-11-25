<!-- gpt is here -->

<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

if (file_exists('./translations.json')) {
    $translations_json = file_get_contents('./translations.json');
    $translations = json_decode($translations_json, true);
} else {
    $translations = [];
}

if (!function_exists('translate')) {
    function translate_qoute($key, $lang, $translations)
    {
        return isset($translations[$lang][$key]) ? $translations[$lang][$key] : ($translations['en'][$key] ?? $key);
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Direct Order</title>
    <!-- Font Awesome for icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" />
    <style>

    </style>
</head>

<body>

    <section style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;" class="main_enquiry">
        <div class="nav_fix_margin"></div>
        <h5 class="main_enquiry_heading" id="qoute_heading">
            <?php echo translate('get_qoute', $lang, $translations); ?>
        </h5>
        <p class="main_enquiry_qoute">
            <?php echo translate('get_qoute_description', $lang, $translations); ?>
        </p>
        <div class="main_enquiry_form">
            <div class="main-enquiry_three_input ">
                <div class="main_enqury_input">
                    <label for="fullName">
                        <?php echo translate('Full Name', $lang, $translations); ?>
                        <span class="main_enqury_input_required">*</span></label>
                    <input type="text" id="fullName" required>
                    <small id="nameError" class="error-message"></small>
                </div>

                <div class="main_enqury_input">
                    <label for="email">
                        <?php echo translate('Email', $lang, $translations); ?>

                        <span class="main_enqury_input_required">*</span></label>
                    <input type="text" id="email" required>
                    <small id="emailError" class="error-message"></small>
                </div>

                <div class="main_enqury_input">
                    <label for="mobileNo">
                        <?php echo translate('Mobile No', $lang, $translations); ?>
                        <span class="main_enqury_input_required">*</span></label>
                    <input type="text" id="mobileNo" pattern="\d{11}" required>
                    <small id="mobileError" class="error-message"></small>
                </div>
            </div>

            <div class="main_enqury_input">
                <label for="message">
                    <?php echo translate('Message', $lang, $translations); ?>
                    <span class="main_enqury_input_required">*</span></label>
                <textarea id="message" rows="4" cols="50" required></textarea>
                <small id="messageError" class="error-message"></small>
            </div>

            <div class="main_enqury_file">
                <label for="fileInput">
                    <?php echo translate('Attach File', $lang, $translations); ?>
                </label>
                <div class="main_enqury_file_box" id="file-drop-area">
                    <!-- The input is now hidden but clickable through the icon -->
                    <input type="file" id="fileInput" hidden>
                    <i class="main_enqury_fileicon fa fa-cloud-upload"></i>
                    <h6>
                        <?php echo translate('Drag and drop a file here / click the icon', $lang, $translations); ?>
                    </h6>
                </div>
                <div id="fileDetails" class="file-details"></div> <!-- Display file info here -->
                <small id="fileError" class="error-message"></small>
            </div>

            <div class="main_enqury_btn-div">
                <button id="submitBtn">
                    <?php echo translate('Send Request', $lang, $translations); ?>
                </button>
            </div>
            <div id="formSuccess" class="success"></div> <!-- Success message will be displayed here -->
        </div>
    </section>

    <script>
        // dynamic routes
        const pathname = window.location.pathname;
        const segments = pathname.split('/');
        const item = decodeURIComponent(segments[segments.length - 1]);

        console.log("item in qouteeeee", item);



        const dropArea = document.getElementById('file-drop-area');
        const fileInput = document.getElementById('fileInput');
        const fileDetails = document.getElementById('fileDetails');
        const uploadIcon = document.querySelector('.main_enqury_fileicon');

        // When the user clicks on the icon, trigger the file input
        uploadIcon.addEventListener('click', (event) => {
            event.stopPropagation(); // Prevent the click from triggering other actions
            fileInput.click();
        });

        // When the file input changes (file is selected by clicking)
        fileInput.addEventListener('change', (event) => {
            handleFiles(event.target.files);
        });

        // Handle dragover event to add visual effect
        dropArea.addEventListener('dragover', (event) => {
            event.preventDefault();
            dropArea.classList.add('drag-over');
        });

        // Remove visual effect when drag leaves the drop area
        dropArea.addEventListener('dragleave', () => {
            dropArea.classList.remove('drag-over');
        });

        // Handle drop event for drag-and-drop file uploads
        dropArea.addEventListener('drop', (event) => {
            event.preventDefault();
            dropArea.classList.remove('drag-over');
            const files = event.dataTransfer.files;
            handleFiles(files);
        });

        // Handle file selection and display file details
        function handleFiles(files) {
            if (files.length > 0) {
                const file = files[0];
                fileDetails.innerHTML = `Selected File: <b>${file.name}</b> (${(file.size / 1024).toFixed(2)} KB)`;
            }
        }




        // Select the form elements
        const fullName = document.getElementById('fullName');
        const email = document.getElementById('email');
        const mobileNo = document.getElementById('mobileNo');
        const message = document.getElementById('message');
        const submitBtn = document.getElementById('submitBtn');
        const formSuccess = document.getElementById('formSuccess');

        // Real-time validation event listeners
        fullName.addEventListener('input', validateFullName);
        email.addEventListener('input', validateEmail);
        mobileNo.addEventListener('input', validateMobile);
        message.addEventListener('input', validateMessage);

        console.log("1. hello");

        // Add event listener for form submission
        submitBtn.addEventListener('click', (event) => {
            event.preventDefault(); // Prevent the form from submitting

            // Perform validation on submit

            // api integration


            // Perform validation on submit
            if (validateForm()) {
                const formData = new FormData();
                formData.append("name", fullName.value);
                formData.append("email", email.value);
                formData.append("mobile", mobileNo.value);
                formData.append("message", message.value);

                if (fileInput.files.length > 0) {
                    formData.append("images[]", fileInput.files[0]);
                }

                // Use async/await for the API call
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
                            clearForm(); // Clear the form after successful submission
                        } else {
                            formSuccess.innerText = '<?php echo translate('Failed to submit the form. Please try again.', $lang, $translations); ?>';
                        }
                    } catch (error) {
                        console.error("Error:", error);
                        formSuccess.innerText = '<?php echo translate('An error occurred. Please try again later.', $lang, $translations); ?>';
                    }
                }

                // Call the function to submit the form
                submitForm();
            } else {
                formSuccess.innerText = ''; // Clear success message if the form is not valid
            }
        });

        // Validate the form before submission
        function validateForm() {
            let valid = true;
            if (!validateFullName()) valid = false;
            if (!validateEmail()) valid = false;
            if (!validateMobile()) valid = false;
            if (!validateMessage()) valid = false;
            if (!validateFile()) valid = false; // File validation
            return valid;
        }

        // File input validation function
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

        // Validation functions
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
            } else if (!mobilePattern.test(mobileNo.value.trim())) {
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

        // Clear the form fields after submission
        function clearForm() {
            fullName.value = '';
            email.value = '';
            mobileNo.value = '';
            message.value = '';
            document.getElementById('fileDetails').innerHTML = '';
            document.querySelectorAll('.error-message').forEach(el => el.innerText = '');
            document.querySelectorAll('input, textarea').forEach(el => el.classList.remove('error'));
        }

        // Get the element by ID to update
        const qouteHeading = document.getElementById('qoute_heading');

        // Check if item exists in the URL
        if (item && item !== 'get-qoute') {
            // Update the inner HTML with the service name (from the URL)
            qouteHeading.innerHTML = item;
        } else {
            // Fallback if no service name is found in the URL
            qouteHeading.innerHTML = "<?php echo translate('get_qoute', $lang, $translations); ?>";
        }
    </script>

</body>

</html>