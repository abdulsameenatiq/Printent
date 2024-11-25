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

<!DOCTYPE html>
<html lang="<?php echo $lang; ?>">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo translate('aboutus_header', $lang, $translations); ?></title>
    <style>
        .about {
            padding: 90px;
            max-width: 1200px;
            margin: auto;
        }

        .about img {
            float: left;
            margin-right: 20px;
            width: 50%;
            height: auto;
        }

        .about p {
            font-size: 18px;
            line-height: 1.6;
            font-family: 'Times New Roman', Times, serif;
        }

        .about h2 {
            font-size: 36px;
            margin-bottom: 20px;
        }

        .container_about {
            background-color: red;
            width: 100%;
            margin-top: 145px;
            background-color: #fff;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>




<div class="container_about">



    <div class="about">
        <img src="images/about-us.jpeg" alt="Company Image">
        <p><?php echo translate('aboutus1', $lang, $translations); ?></p>
        <p><?php echo translate('aboutus2', $lang, $translations); ?></p>
        <br><br>
        <p><?php echo translate('aboutus3', $lang, $translations); ?></p>
        <p><?php echo translate('aboutus4', $lang, $translations); ?></p>
    </div>
</div>


</html>