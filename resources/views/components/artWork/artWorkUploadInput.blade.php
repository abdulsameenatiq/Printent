<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_detailupload($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>


<section
    style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="upload-main--container">
    <!-- 1st container -->
    <section id="container1" class="upload-design-container active contan">
        <div class="upload-area">
            <button class="upload-button" data-bs-toggle="modal" data-bs-target="#uploadNewDesign00">
                <?php echo translate('product_upload', $lang, $translations); ?>

            </button>
        </div>
        <p class="upload-info text-center pb-0 mb-0">
            <?php echo translate('product_upload_desc', $lang, $translations); ?>

        </p>
    </section>

    <!-- 2nd container -->
    <section
        style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
        id="container2" class="d-none contan">
        <table class="table">
            <tbody>
                <tr>
                    <td>1</td>
                    <td>
                        <div> <?php echo translate('title', $lang, $translations); ?>:</div>
                        <div> <?php echo translate('design_tags', $lang, $translations); ?>:</div>
                    </td>
                </tr>
                <tr>
                    <td>2</td>
                    <td>
                        <div> <?php echo translate('title', $lang, $translations); ?>:</div>
                        <div> <?php echo translate('design_tags', $lang, $translations); ?>:</div>
                    </td>
                </tr>
                <tr>
                    <td>3</td>
                    <td>
                        <div> <?php echo translate('title', $lang, $translations); ?>:</div>
                        <div> <?php echo translate('design_tags', $lang, $translations); ?>:</div>

                    </td>
                </tr>
            </tbody>
        </table>
    </section>

    <!-- 3rd container -->
    <section id="container3" class="upload-design-container d-none contan">
        <p class="text-center text-black">
            <?php echo translate('paste_url', $lang, $translations); ?>:
        </p>
        <div>
            <div class="link-input">
                <label for="link">
                    <?php echo translate('link', $lang, $translations); ?>
                    *</label>
                <input type="email" class="form-control rounded-pill" id="link">
            </div>
        </div>
    </section>
</section>