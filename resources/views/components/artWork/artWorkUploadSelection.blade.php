<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_sign_up($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<div class="row upload-top--button">
    <div class="col-lg-7 col-md-9 col-12 mx-auto">
        <div class="row g-0">

            <!-- First Button Card -->
            <div class="col-sm-4 col-4 px-md-3 px-sm-2 px-1">
                <button class="card text-center position-relative w-100 p-0 pb-4 uplaod-button" type="button">
                    <input type="radio" id="radio1" name="customRadio"
                        class="custom-radio position-absolute top-0 end-0 m-3" checked />
                    <label for="radio1" class="d-flex flex-column justify-content-center h-100 w-100">
                        <div class="d-flex justify-content-center">
                            <img style="margin-top: 30px;filter: sepia(1) hue-rotate(-50deg) saturate(5) brightness(0.8) contrast(1.2);"
                                width="55" height="55" class="img-fluid" src="images/art-work/art-image-1.png"
                                alt="Art 1" />
                        </div>
                        <div class="mt-2 title">
                            <?php echo translate('art_upload', $lang, $translations); ?>

                        </div>
                    </label>
                </button>
            </div>

            <!-- Second Button Card -->
            <div class="col-sm-4 col-4 px-md-3 px-sm-2 px-1">
                <button class="card text-center position-relative w-100 p-0 pb-4 uplaod-button" type="button">
                    <input type="radio" id="radio2" name="customRadio"
                        class="custom-radio position-absolute top-0 end-0 m-3" />
                    <label for="radio2" class="d-flex flex-column justify-content-center h-100 w-100">
                        <div class="d-flex justify-content-center">
                            <img style="margin-top: 30px;filter: sepia(1) hue-rotate(-50deg) saturate(5) brightness(0.8) contrast(1.2);"
                                width="60" height="60" class="img-fluid" src="images/art-work/art-image-2.png"
                                alt="Art 2" />
                        </div>
                        <div class="mt-2 px-3 title">
                            <?php echo translate('art_choose', $lang, $translations); ?>

                        </div>
                    </label>
                </button>
            </div>

            <!-- Third Button Card -->
            <!-- <div class="col-sm-4 col-4 px-md-3 px-sm-2 px-1">
                <button class="card text-center position-relative w-100 p-0 pb-4 uplaod-button" type="button">
                    <input type="radio" id="radio3" name="customRadio"
                        class="custom-radio position-absolute top-0 end-0 m-3" />
                    <label for="radio3" class="d-flex flex-column justify-content-center h-100 w-100">
                        <div class="d-flex justify-content-center">
                            <img style="margin-top: 30px;filter: sepia(1) hue-rotate(-50deg) saturate(5) brightness(0.8) contrast(1.2);"
                                width="60" height="60" class="img-fluid" src="images/art-work/art-image-3.png"
                                alt="Art 3" />
                        </div>
                        <div class="mt-2 title">Share A Link</div>
                    </label>
                </button>
            </div> -->

        </div>
    </div>
</div>