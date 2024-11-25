<!--Language translator functionality  -->
<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_shipping($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>
<section style=" text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="prt-row padding_zero-section clearfix">
    <div class="container">
        <div class="row g-0">
            <div class="col-xl-6 col-lg-6">
                <!-- col-bg-img-two -->
                <div class="prt-bg prt-col-bgimage-yes col-bg-img-one prt-left-span">
                    <div class="prt-col-wrapper-bg-layer prt-bg-layer"></div>
                    <div class="layer-content"></div>
                </div>
                <!-- col-bg-img-two end -->
                <img class="img-fluid prt-equal-height-image" src="images/bg-image/col-bgimage-1.jpg" alt="bg-image">
            </div>
            <div class="col-xl-6 col-lg-6">
                <div class="prt-bg prt-col-bgcolor-yes bg-base-skin prt-right-span z-index-1 spacing-2">
                    <div class="prt-col-wrapper-bg-layer prt-bg-layer"></div>
                    <div class="layer-content">
                        <div class="section-title style2">
                            <div class="title-header">
                                <h2>
                                    <?php echo translate('shipping_heading', $lang, $translations); ?>

                                </h2>
                            </div>
                        </div>
                        
                        <div class="title-desc d-inline-block">
                            <p>
                                <?php echo translate('shipping_description1', $lang, $translations); ?>

                                <br>
                                <?php echo translate('shipping_description2', $lang, $translations); ?>

                            </p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>