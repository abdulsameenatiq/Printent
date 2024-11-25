<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_accountstabs($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>
<section style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="container main-custom-tab">
    <h2 class="title">
        <?php echo translate('my_account', $lang, $translations); ?>
    </h2>
    <!-- First Tab: Shown on screens larger than md -->
    <ul class="d-flex justify-content-between custom-tab d-none d-md-flex">
        <li class="border">
            <a class="link active" aria-current="page" href="/personal-profile">
                <?php echo translate('profile_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border">
            <a class="link" href="/my-designs">
                <?php echo translate('design_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border">
            <a class="link" href="/order-history">
                <?php echo translate('order_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border">
            <a class="link" href="/past-orders">
                <?php echo translate('history_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border">
            <a class="link" href="/shipping-address">
                <?php echo translate('address_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border">
            <a class="link" href="/payment">
                <?php echo translate('payment_tab', $lang, $translations); ?>

            </a>
        </li>
    </ul>

    <!-- Second Tab: Shown on screens smaller than md -->
    <ul class="d-flex flex-wrap justify-content-between custom-tab d-flex d-md-none">
        <li class="border flex-grow-1 sm:w-1/2 md:w-full">
            <a class="link active" aria-current="page" href="/personal-profile">
                <?php echo translate('profile_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border flex-grow-1 sm:w-1/2 md:w-full">
            <a class="link" href="/my-designs">
                <?php echo translate('design_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border flex-grow-1 sm:w-1/2 md:w-full">
            <a class="link" href="/order-history">
                <?php echo translate('order_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border flex-grow-1 sm:w-1/2 md:w-full">
            <a class="link" href="/past-orders">
                <?php echo translate('history_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border flex-grow-1 sm:w-1/2 md:w-full">
            <a class="link" href="/shipping-address">
                <?php echo translate('address_tab', $lang, $translations); ?>

            </a>
        </li>
        <li class="border flex-grow-1 sm:w-1/2 md:w-full">
            <a class="link" href="/payment">
                <?php echo translate('payment_tab', $lang, $translations); ?>

            </a>
        </li>
    </ul>


    <script>
        const currentPath = window.location.pathname;

        const navLinks = document.querySelectorAll('.custom-tab .link');
        console.log("navLinks", navLinks);

        navLinks.forEach(link => {
            if (link.getAttribute('href') === currentPath) {
                link.classList.add('active');
            } else {
                link.classList.remove('active');
            }
        });
    </script>


</section>