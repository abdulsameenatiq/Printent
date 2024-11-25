<!--Language translator functionality  -->
<?php

$lang = isset($_GET['lang']) ? $_GET['lang'] : 'en';

// Load translations from the JSON file
$translations_json = file_get_contents('./translations.json');
$translations = json_decode($translations_json, true);

function translate_portfolio($key, $lang, $translations)
{
    return isset($translations[$lang][$key]) ? $translations[$lang][$key] : $translations['en'][$key];
}
?>

<section class="prt-row portfolio-section bg-img2 bg-base-dark clearfix">
    <div class="prt-row-wrapper-bg-layer"></div>
    <div class="container">
        <div class="row">
            <div class="col-md-7">
                <div class="section-title">
                    <div class="title-header">
                        <h2 class="title">
                            <?php echo translate('portfolio_heading1', $lang, $translations); ?>

                            <span class="prt-border">
                                <?php echo translate('portfolio_heading2', $lang, $translations); ?>

                            </span>
                            <?php echo translate('portfolio_heading3', $lang, $translations); ?>

                        </h2>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="section-title style1">
                    <div class="title-header">
                        <h2>250+</h2>
                    </div>
                    <div class="title-desc">
                        <p>
                            <?php echo translate('portfolio_projects', $lang, $translations); ?>

                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="container-fluid p-0">
        <div class="row g-0 slick_slider slider-img mt-60 res-991-mt-0"
            data-slick='{"slidesToShow": 4, "slidesToScroll": 1, "arrows":false, "autoplay":false, "dots":false, "infinite":true, "responsive":[{"breakpoint":1199,"settings":{"slidesToShow": 3}},{"breakpoint":992,"settings":{"slidesToShow": 2}},{"breakpoint":767,"settings":{"slidesToShow": 2}},{"breakpoint":575,"settings":{"slidesToShow": 1}},{"breakpoint":480,"settings":{"slidesToShow": 1}}]}'>
            <div class="col-lg-4 col-md-6">
                <div class="featured-imagebox featured-imagebox-portfolio style1">
                    <div class="prt-post-item">
                        <div class="item-figure">
                            <div class="featured-thumbnail">
                                <a href="single-style-1.html" tabindex="0"><img class="img-fluid"
                                        src="images/portfolio/portfolio-6-600x700.jpg" width="600" height="700"
                                        alt=""></a>
                            </div>
                            <div class="readmore_btn">
                                <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey"
                                    href="single-style-1.html">View Full Project</a>
                            </div>
                        </div>
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3>Mug design printing</h3>
                            </div>
                            <div class="featured-desc">
                                <p>A printer draws an image or design on special paper to cover is
                                    applied to slide.</p>
                            </div>
                            <div class="prt-icon-box">
                                <a href="single-style-1.html"><i class="flaticon-right-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="featured-imagebox featured-imagebox-portfolio style1">
                    <div class="prt-post-item">
                        <div class="item-figure">
                            <div class="featured-thumbnail">
                                <a href="single-style-1.html" tabindex="0"><img class="img-fluid"
                                        src="images/portfolio/portfolio-2-600x700.jpg" width="600" height="700"
                                        alt=""></a>
                            </div>
                            <div class="readmore_btn">
                                <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey"
                                    href="single-style-2.html">View Full Project</a>
                            </div>
                        </div>
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3>Poster flyer printing</h3>
                            </div>
                            <div class="featured-desc">
                                <p>Support digital transformation initiatives are a material used to
                                    improve productivity.</p>
                            </div>
                            <div class="prt-icon-box">
                                <a href="single-style-2.html"><i class="flaticon-right-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="featured-imagebox featured-imagebox-portfolio style1">
                    <div class="prt-post-item">
                        <div class="item-figure">
                            <div class="featured-thumbnail">
                                <a href="single-style-1.html" tabindex="0"><img class="img-fluid"
                                        src="images/portfolio/portfolio-1-600x700.jpg" width="600" height="700"
                                        alt=""></a>
                            </div>
                            <div class="readmore_btn">
                                <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey"
                                    href="single-style-3.html">View Full Project</a>
                            </div>
                        </div>
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3>Magazines and journal</h3>
                            </div>
                            <div class="featured-desc">
                                <p>Newspapers and magazines are printed that are published regularly
                                    from time to time.</p>
                            </div>
                            <div class="prt-icon-box">
                                <a href="single-style-3.html"><i class="flaticon-right-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="featured-imagebox featured-imagebox-portfolio style1">
                    <div class="prt-post-item">
                        <div class="item-figure">
                            <div class="featured-thumbnail">
                                <a href="single-style-1.html" tabindex="0"><img class="img-fluid"
                                        src="images/portfolio/portfolio-3-600x700.jpg" width="600" height="700"
                                        alt=""></a>
                            </div>
                            <div class="readmore_btn">
                                <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey"
                                    href="single-style-2.html">View Full Project</a>
                            </div>
                        </div>
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3>Digital printing</h3>
                            </div>
                            <div class="featured-desc">
                                <p>Used mostly for borders and murals, digital printing is defined as
                                    one several technologies.</p>
                            </div>
                            <div class="prt-icon-box">
                                <a href="single-style-2.html"><i class="flaticon-right-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="featured-imagebox featured-imagebox-portfolio style1">
                    <div class="prt-post-item">
                        <div class="item-figure">
                            <div class="featured-thumbnail">
                                <a href="single-style-1.html" tabindex="0"><img class="img-fluid"
                                        src="images/portfolio/portfolio-5-600x700.jpg" width="600" height="700"
                                        alt=""></a>
                            </div>
                            <div class="readmore_btn">
                                <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey"
                                    href="single-style-1.html">View Full Project</a>
                            </div>
                        </div>
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3>Sublimation printing</h3>
                            </div>
                            <div class="featured-desc">
                                <p>We provide exactly the solution you need meet your business needs.
                                </p>
                            </div>
                            <div class="prt-icon-box">
                                <a href="single-style-1.html"><i class="flaticon-right-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-6">
                <div class="featured-imagebox featured-imagebox-portfolio style1">
                    <div class="prt-post-item">
                        <div class="item-figure">
                            <div class="featured-thumbnail">
                                <a href="single-style-1.html" tabindex="0"><img class="img-fluid"
                                        src="images/portfolio/portfolio-1-600x700.jpg" width="600" height="700"
                                        alt=""></a>
                            </div>
                            <div class="readmore_btn">
                                <a class="prt-btn prt-btn-size-md btn-inline prt-btn-color-darkgrey"
                                    href="single-style-2.html">View Full Project</a>
                            </div>
                        </div>
                        <div class="featured-content">
                            <div class="featured-title">
                                <h3>Magazines and journal</h3>
                            </div>
                            <div class="featured-desc">
                                <p>Newspapers and magazines are printed that are published regularly
                                    from time to time.</p>
                            </div>
                            <div class="prt-icon-box">
                                <a href="single-style-2.html"><i class="flaticon-right-down"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div> -->
</section>