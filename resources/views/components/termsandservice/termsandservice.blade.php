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

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo translate('terms_of_services_title', $lang, $translations); ?></title>
    <style>
        /* body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            /* display: flex; */
        /* justify-content: center; */
        /* align-items: center; */
        /* height: 210vh; */
        /* } */

        .container_term {
            width: 100%;
            /* margin: 20px auto; */
            margin-top: 145px;
            background-color: #fff;
            /* background-color: red; */
            padding: 20px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            /* max-height: 100vh; */
            /* Limit height to half the page */
            /* overflow-y: auto; */
            /* Enable vertical scrolling */
            /* background-color: #fff; */
            /* padding: 20px; */
            /* padding-top: 140px; */
            /* border-radius: 5px; */
            /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
        }

        h1 {
            font-size: 25px;
            margin-bottom: 20px;
            font-family: Arial, Helvetica, sans-serif;
        }

        ol {
            padding-left: 20px;
            font-family: 'Times New Roman', Times, serif;
        }

        ol li {
            font-size: 18px;
            margin-bottom: 10px;
            font-family: 'Times New Roman', Times, serif;
        }

        .note {
            font-style: italic;
            color: #000000;
        }
    </style>
</head>

<body>
    <div class="container_term">
        <h1><?php echo translate('terms_of_services_title', $lang, $translations); ?></h1>
        <ol>
            <li><?php echo translate('terms_of_services_order', $lang, $translations); ?></li>
            <li class="note"><strong><?php echo translate('terms_of_services_note', $lang, $translations); ?></strong>
            </li>
            <li><?php echo translate('terms_of_services_changes_not_allowed', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_changes_specifications', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_government_logo', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_stamp_orders', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_book_orders', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_order_timing', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_delivery', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_turnaround', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_goods', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_check_materials', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_indirect_loss', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_information_check', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_design_service', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_color_guarantee', $lang, $translations); ?></li>
            <li><?php echo translate('terms_of_services_process_colors', $lang, $translations); ?></li>
        </ol>
    </div>
</body>

</html>