<!--Language translator functionality  -->
<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_wecreate($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<section style="direction: <?php echo $lang == 'ar' ? 'rtl' : 'ltr'; ?>; text-align: <?php echo $lang == 'ar' ? 'right' : 'left'; ?>;"
    class="prt-row bg-img1 bg-base-grey prt-bg prt-bgimage-yes fid-section clearfix">
    <div class="prt-row-wrapper-bg-layer prt-bg-layer"></div>
    <div class="container">
        <div class="row">
            <div class="col-lg-6">
                <div class="prt_single_image-wrapper">
                    <img width="610" height="530" class="img-fluid" src="images/single-img-1-610x506.jpg"
                        alt="single-1">
                </div>
            </div>
            <div class="col-lg-6">
                <div class="section-title res-991-mt-20 res-767-mb-0">
                    <div class="title-header">
                        <h2 class="title">
                            <?php echo translate('we_create_heading1', $lang, $translations); ?>
                            <span class="prt-border">
                                <?php echo translate('we_create_heading2', $lang, $translations); ?>

                            </span>
                            <?php echo translate('we_create_heading3', $lang, $translations); ?>

                        </h2>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-5">
                        <div class="featured-icon-box without-icon style1">
                            <div class="featured-title">
                                <span class="prt-bottom-border"><span class="prt-icon">#</span>
                                    <?php echo translate('we_create_best_service', $lang, $translations); ?>

                                </span>
                                <?php echo translate('we_create_printing_service', $lang, $translations); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="featured-icon-box without-icon style1">
                            <div class="featured-content">
                                <div class="featured-desc">
                                    <p>
                                        <?php echo translate('we_create_desc1', $lang, $translations); ?>

                                    </p>
                                </div>
                            </div>
                            <div class="featured-bottom">
                                <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey mb-50 mt-10 res-767-mb-0 res-991-mb-0"
                                    href="papltets-design.html">
                                    <?php echo translate('we_create_read_more', $lang, $translations); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-5">
                        <div class="featured-icon-box without-icon style1">
                            <div class="featured-title">
                                <span class="prt-bottom-border"><span class="prt-icon">#

                                    </span>
                                    <?php echo translate('we_create_best_town', $lang, $translations); ?>

                                </span>
                                <?php echo translate('we_create_service_town', $lang, $translations); ?>

                            </div>
                        </div>
                    </div>
                    <div class="col-md-7">
                        <div class="featured-icon-box without-icon style1">
                            <div class="featured-content">
                                <div class="featured-desc">
                                    <p>
                                        <?php echo translate('we_create_desc2', $lang, $translations); ?>

                                    </p>
                                </div>
                            </div>
                            <div class="featured-bottom">
                                <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey"
                                    href="business-card-design.html">
                                    <?php echo translate('we_create_read_more', $lang, $translations); ?>

                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-70 res-991-pt-20 res-575-pt-0">
            <div class="row prt-facts-colum-sep">
                <div class="col-lg-3 col-md-6 col-sm-6 position-relative res-767-pb-40 res-575-pb-0">
                    <!-- prt-fid -->
                    <div class="prt-fid inside style1">
                        <div class="prt-fid-contents">
                            <h4 class="prt-fid-inner">
                                <span data-appear-animation="animateDigits" data-from="0" data-to="2845"
                                    data-interval="5" data-before="" data-before-style="sup" data-after=""
                                    data-after-style="sub" class="numinate">2845
                                </span>
                                <sup>+</sup>
                            </h4>
                            <p class="prt-fid-title">
                                <?php echo translate('satisfied_clients', $lang, $translations); ?>

                            </p>
                        </div>
                    </div><!-- prt-fid end -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 position-relative res-767-pb-40 res-575-pb-0">
                    <!-- prt-fid -->
                    <div class="prt-fid inside style1">
                        <div class="prt-fid-contents">
                            <h4 class="prt-fid-inner">
                                <span data-appear-animation="animateDigits" data-from="0" data-to="1565"
                                    data-interval="5" data-before="" data-before-style="sup" data-after=""
                                    data-after-style="sub" class="numinate">1565
                                </span>
                                <sup>+</sup>
                            </h4>
                            <p class="prt-fid-title">
                                <?php echo translate('completed_delivery', $lang, $translations); ?>

                            </p>
                        </div>
                    </div><!-- prt-fid end -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 position-relative res-767-pb-0">
                    <!-- prt-fid -->
                    <div class="prt-fid inside style1">
                        <div class="prt-fid-contents">
                            <h4 class="prt-fid-inner">
                                <span data-appear-animation="animateDigits" data-from="0" data-to="4568"
                                    data-interval="5" data-before="" data-before-style="sup" data-after=""
                                    data-after-style="sub" class="numinate">4568
                                </span>
                                <sup>+</sup>
                            </h4>
                            <p class="prt-fid-title">
                                <?php echo translate('awards_winner', $lang, $translations); ?>

                            </p>
                        </div>
                    </div><!-- prt-fid end -->
                </div>
                <div class="col-lg-3 col-md-6 col-sm-6 res-767-pb-0">
                    <!-- prt-fid -->
                    <div class="prt-fid inside style1">
                        <div class="prt-fid-contents">
                            <h4 class="prt-fid-inner">
                                <span data-appear-animation="animateDigits" data-from="0" data-to="3845"
                                    data-interval="5" data-before="" data-before-style="sup" data-after=""
                                    data-after-style="sub" class="numinate">3845
                                </span>
                                <sup>+</sup>
                            </h4>
                            <p class="prt-fid-title">
                                <?php echo translate('team_members', $lang, $translations); ?>

                            </p>
                        </div>
                    </div><!-- prt-fid end -->
                </div>
            </div>
        </div>
    </div>
</section>