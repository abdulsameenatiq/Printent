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

<!-- page-title -->
<div class="prt-titlebar-wrapper prt-bg about-img-01">
    <div class="prt-titlebar-wrapper-bg-layer prt-bg-layer"></div>
    <div class="prt-titlebar-wrapper-inner">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-12">
                    <div class="prt-page-title-row-heading">
                        <div class="page-title-heading">
                            <h2 class="title"><?php echo translate('all_products', $lang, $translations); ?></h2>
                        </div>
                        <div class="breadcrumb-wrapper">
                            <i class="flaticon-home"></i>
                            <span>
                                <a title="Homepage"
                                    href="index-2.html"><?php echo translate('home', $lang, $translations); ?></a>
                            </span>
                            <div class="prt-sep"> - </div>
                            <span><?php echo translate('shop', $lang, $translations); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- page-title end -->