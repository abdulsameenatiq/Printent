<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

if (file_exists('./translations.json')) {
    $translations_json = file_get_contents('./translations.json');
    $translations = json_decode($translations_json, true);
} else {
    $translations = [];
}

if (!function_exists('translate')) {
    function translate($key, $lang, $translations)
    {
        return isset($translations[$lang][$key]) ? $translations[$lang][$key] : ($translations['en'][$key] ?? $key);
    }
}
?>

<section style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="main_trackOrder">
    <div class="nav_fix_margin"></div>
    <h5 class="trackorder_h1"><?php echo translate('track_order', $lang, $translations); ?></h5>

    <div class="track_main_form">
        <div class="track_maininput">
            <input id="orderNo" class="track_form_input" type="text"
                placeholder="<?php echo translate('order_no_placeholder', $lang, $translations); ?>" required>
            <small id="orderNoError" class="error-message"></small>

            <input id="email" class="track_form_input" type="email"
                placeholder="<?php echo translate('email_placeholder', $lang, $translations); ?>" required>
            <small id="emailError" class="error-message"></small>
            <div id="formSuccess" class="success"></div>

            <div class="track_main_btn">
                <button id="trackBtn"
                    class="track_form_btn"><?php echo translate('track', $lang, $translations); ?></button>
            </div>
        </div>
    </div>

    <!-- table -->
    <table class="order-table">
        <thead>
            <tr>
                <th><?php echo translate('products', $lang, $translations); ?></th>
                <th><?php echo translate('order_date', $lang, $translations); ?></th>
                <th><?php echo translate('shipped_to', $lang, $translations); ?></th>
                <th><?php echo translate('order_number', $lang, $translations); ?></th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="no-order"><?php echo translate('no_order_available', $lang, $translations); ?>
                </td>
            </tr>
        </tbody>
    </table>
</section>

<script>
    // Select the form elements
    const orderNo = document.getElementById('orderNo');
    const email = document.getElementById('email');
    const trackBtn = document.getElementById('trackBtn');
    const formSuccess = document.getElementById('formSuccess');

    // Add event listener for form submission
    trackBtn.addEventListener('click', (event) => {
        event.preventDefault(); // Prevent the form from submitting

        if (validateForm()) {
            formSuccess.innerText = '<?php echo translate('form_success', $lang, $translations); ?>';
            formSuccess.style.display = 'block';

            // Clear the form or do actual form submission (AJAX/Fetch request)
            clearForm();
        } else {
            formSuccess.innerText = '';
        }
    });

    // Validate the form
    function validateForm() {
        let valid = true;

        // Reset error messages
        document.getElementById('orderNoError').innerText = "";
        document.getElementById('emailError').innerText = "";

        // Validate Order Number (Check if it's empty)
        if (orderNo.value.trim() === "") {
            document.getElementById('orderNoError').innerText = "<?php echo translate('order_no_required', $lang, $translations); ?>";
            valid = false;
        }

        // Validate Email
        if (email.value.trim() === "") {
            document.getElementById('emailError').innerText = "<?php echo translate('email_required', $lang, $translations); ?>";
            valid = false;
        } else if (!isValidEmail(email.value)) {
            document.getElementById('emailError').innerText = "<?php echo translate('invalid_email', $lang, $translations); ?>";
            valid = false;
        }

        return valid;
    }

    // Email validation function
    function isValidEmail(email) {
        const emailPattern = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
        return emailPattern.test(email);
    }

    function clearForm() {
        orderNo.value = "";
        email.value = "";
    }
</script>

<!-- 
<style>
    .error-message {
        color: red;
        font-size: 12px;
        margin-top: 4px;
        display: block;
    }
</style> -->