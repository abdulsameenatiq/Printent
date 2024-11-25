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
    <title><?php echo translate('trust_and_safety_title', $lang, $translations); ?></title>
    <style>
        /* /body {
            padding: 50px 0 0 0;
            padding-top: 100vh */
        /* font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4; */
        /* display: flex; */
        /* justify-content: center; */
        /* align-items: center; */
        /* height: 210vh; */

        /* } */

        .container_trust {
            width: 100%;
            max-height: 100vh;
            padding: 20px;
            /* padding-top: 200px; */
            /* margin: 20px auto; */
            margin-top: 145px;
            background-color: #fff;
            /* background-color: red; */
            /* padding-top: 140px; */
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 25px;
            margin-bottom: 20px;
            font-family: 'Times New Roman', Times, serif;
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

    <div class="container_trust">
        <h1><?php echo translate('trust_and_safety_title', $lang, $translations); ?></h1>
        <ul>
            <li><?php echo translate('trust_and_safety_commitment', $lang, $translations); ?></li>
            <li class="note"><strong><?php echo translate('trust_and_safety_note', $lang, $translations); ?></strong>
            </li>
            <li><?php echo translate('trust_and_safety_changes', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_specifications', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_logo', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_stamp', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_book', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_orders', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_delivery', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_goods', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_check', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_indirect_loss', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_information', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_design', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_colors', $lang, $translations); ?></li>
            <li><?php echo translate('trust_and_safety_process_colors', $lang, $translations); ?></li>
        </ul>
    </div>

</body>

</html>