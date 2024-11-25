<?php
// Load translations from the JSON file only once
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



<!-- footer start -->
<footer
    style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="footer prt-bgimage-yes bg-footer prt-bg bg-base-dark clearfix">
    <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
    <div class="first-footer">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 widget-area">
                    <h3><?php echo translate('footer_intro', $lang, $translations); ?></h3>

                </div>
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-6 widget-area">
                    <form id="subscribe-form" class="newsletter-form" method="post" action="#" data-mailchimp="true"
                        onsubmit="openEmailClient(event)">
                        <h3 class="widget-title"><?php echo translate('footer_contact_prompt', $lang, $translations); ?>
                        </h3>
                        <div class="mailchimp-inputbox clearfix" id="subscribe-content">
                            <input type="email" id="emailField" name="email"
                                placeholder="<?php echo translate('footer_email_placeholder', $lang, $translations); ?>"
                                required="">

                            <button class="submit prt-btn prt-btn-size-md prt-btn-style-fill"
                                type="submit"><?php echo translate('send', $lang, $translations); ?></button>
                        </div>
                        <div id="subscribe-msg"></div>


                    </form>
                </div>
            </div>
        </div>

    </div>
    <div class="second-footer">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 widget-area">
                    <div class="widget widget_text clearfix">
                        <h3 class="widget-title"><?php echo translate('about_us', $lang, $translations); ?></h3>
                        <div class="textwidget widget-text">
                            <p><?php echo translate('about_us_description', $lang, $translations); ?></p>
                        </div>
                        <div class="social-icons circle mt-30">
                            <ul class="list-inline">
                                <li class="social-linkedin"><a class="tooltip-top" target="_blank"
                                        href="https://in.facebook.com/themetechmount/_created/"
                                        data-tooltip="Facebook"><i class="ti ti-facebook"></i></a></li>
                                <li class="social-twitter"><a class="tooltip-top" target="_blank"
                                        href="https://twitter.com/themetechmount" data-tooltip="Twitter"><i
                                            class="ti ti-twitter"></i></a></li>
                                <li class="social-pinterest"><a class="tooltip-top" target="_blank"
                                        href="https://in.pinterest.com/themetechmount/_created/"
                                        data-tooltip="Pinterest"><i class="ti ti-pinterest"></i></a></li>
                                <li class="social-linkedin"><a class="tooltip-top" target="_blank"
                                        href="https://in.linkedin.com/themetechmount/_created/"
                                        data-tooltip="LinkedIn"><i class="ti ti-linkedin"></i></a></li>
                            </ul>
                        </div>
                        <span>
                            <?php echo translate('printed_theme', $lang, $translations); ?>
                            <a href="https://www.crelogics.com/">
                                <?php echo translate('printed_by', $lang, $translations); ?>
                            </a></span>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2 widget-area">
                    <div class="widget widget_nav_menu clearfix">
                        <h3 class="widget-title"><?php echo translate('quick_links', $lang, $translations); ?></h3>
                        <ul id="menu-footer-service-link" class="menu">
                            <li><a href="/"><?php echo translate('home', $lang, $translations); ?></a></li>
                            <li><a href="/products"><?php echo translate('products', $lang, $translations); ?></a>
                            <li><a href="/track-order"><?php echo translate('track_order', $lang, $translations); ?></a>
                            </li>
                            <li><a href="/get-qoute"><?php echo translate('get_qoute', $lang, $translations); ?></a>
                            </li>
                            <li><a href="/enquiry"><?php echo translate('direct_order', $lang, $translations); ?></a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-2 widget-area">
                    <div class="widget widget_nav_menu clearfix">
                        <h3 class="widget-title"><?php echo translate('important_links', $lang, $translations); ?></h3>
                        <ul class="menu">
                            <li><a href="/aboutus"><?php echo translate('about_us', $lang, $translations); ?></a>
                            </li>
                            <li><a
                                    href="/privacypolicy"><?php echo translate('privacy_policy', $lang, $translations); ?></a>
                            </li>
                            <li><a
                                    href="/terms-service"><?php echo translate('terms_of_services', $lang, $translations); ?></a>
                            </li>
                            <li><a
                                    href="trust-safety"><?php echo translate('trust_&_safety', $lang, $translations); ?></a>
                            </li>

                        </ul>
                    </div>
                </div>
                <div class="col-xs-12 col-sm-12 col-md-6 col-lg-4 widget-area">
                    <div class="widget widget-timing clearfix">
                        <h3 class="widget-title"><?php echo translate('get_in_touch', $lang, $translations); ?></h3>
                        <p><?php echo translate('footer_locations', $lang, $translations); ?></p>
                        <ul class="widget_contact_wrapper">
                            <li class="mb-30 mt-20"><?php echo translate('call_us', $lang, $translations); ?>: <a
                                    href="tel:1234567890">+123 456 78900</a></li>
                            <li><?php echo translate('email1', $lang, $translations); ?>: <a
                                    href="mailto:info@example.com">info.support@domain.com</a></li>
                            <li><?php echo translate('email2', $lang, $translations); ?>: <a
                                    href="mailto:info@example.com">info.support@domain.com</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- footer end -->


<script>
    function openEmailClient(event) {
        // Prevent the form's default submission behavior
        event.preventDefault();

        // Get the email from the input field
        const emailField = document.getElementById('emailField');

        if (emailField) {
            const email = emailField.value;

            // Check if an email was entered
            if (email) {
                const mailtoLink = `mailto:${email}`;

                // Confirm with the user before opening the email client
                const userConfirmation = confirm("Do you want to open your email client to send an email to " + email + "?");

                // Open the mailto link if confirmed
                if (userConfirmation) {
                    window.location.href = mailtoLink;
                }
            } else {
                alert('Please enter a valid email address.');
            }
        } else {
            console.error('Email input field not found.');
        }
    }

    // Ensure the DOM is fully loaded before attaching event listeners
    document.addEventListener('DOMContentLoaded', function() {
        const form = document.getElementById('subscribe-form');
        if (form) {
            form.addEventListener('submit', openEmailClient);
        } else {
            console.error('Subscribe form not found.');
        }
    });
</script>