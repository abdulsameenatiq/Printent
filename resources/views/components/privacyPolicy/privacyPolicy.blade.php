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
    <title><?php echo translate('privacy_policy_title', $lang, $translations); ?></title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            /* height: 210vh; */
        }

        .scrollable-container {
            width: 100%;
            max-height: 100vh;
            /* Limit height to half the page */
            /* overflow-y: auto; */
            /* Enable vertical scrolling */
            background-color: #fff;
            padding: 20px;
            padding-top: 140px;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 2em;
            color: #333;
        }

        h2 {
            font-size: 1.5em;
            color: #333;
        }

        p {
            font-size: 1em;
            line-height: 1.6;
            color: #666;
            font-family: 'Times New Roman', Times, serif;
        }

        a {
            color: #0056b3;
            text-decoration: none;
        }

        a:hover {
            text-decoration: underline;
        }

        .highlight {
            font-weight: bold;
        }

        .section-title {
            color: #222;
            margin-top: 20px;
            margin-bottom: 10px;
        }

        .info-section {
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="scrollable-container">
        <h1><?php echo translate('privacy_policy_title', $lang, $translations); ?></h1>
        <p>
            <span class="highlight">Printent</span> ("we" or “our” or "us") are committed to protecting and
            respecting your privacy. “You” or “your” means you as the user of our Website.
        </p>
        <p>
            <?php echo translate('privacy_policy_intro', $lang, $translations); ?>
        </p>
        <p>
            <strong><?php echo translate('privacy_policy_please_read', $lang, $translations); ?></strong>
        </p>

        <div class="info-section">
            <h2 class="section-title">
                <?php echo translate('privacy_policy_information_collection_title', $lang, $translations); ?>
            </h2>
            <p>
                <strong>1.1.</strong>
                <?php echo translate('privacy_policy_information_collection_intro', $lang, $translations); ?>
            </p>
            <ul>
                <li><?php echo translate('privacy_policy_information_contact', $lang, $translations); ?></li>
                <li><?php echo translate('privacy_policy_information_service_contact', $lang, $translations); ?></li>
                <li><?php echo translate('privacy_policy_information_mobile_app', $lang, $translations); ?></li>

            </ul>
            <p>
                <strong>1.2.</strong>
                <?php echo translate('privacy_policy_information_details', $lang, $translations); ?>
            </p>
            <ul>
                <li><?php echo translate('privacy_policy_information_company_details', $lang, $translations); ?></li>
                <li><?php echo translate('privacy_policy_information_personal_details', $lang, $translations); ?></li>
                <li><?php echo translate('privacy_policy_information_device_details', $lang, $translations); ?></li>
                <li><?php echo translate('privacy_policy_information_visit_details', $lang, $translations); ?></li>
            </ul>
        </div>
    </div>
</body>


</html>