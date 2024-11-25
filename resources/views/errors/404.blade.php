@extends('components.layout.layout')

@section('content')

<body>
    <div class="page">
        @include('components.home.navbar')
        @include('components.product.title')

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

        <div class="site-main">
            <!--error-404-->
            <section class="error-404 clearfix">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6 res-991-mt-30 order-last order-lg-first m-auto">
                            <div class="prt-404-img text-center">
                                <img width="524" height="222" class="img-fluid" src="images/404-01.png" alt="error.png">
                            </div>
                            <div class="text-center">
                                <div class="page-content">
                                    <h2><?php echo translate('page_not_found', $lang, $translations); ?></h2>
                                    <p><?php echo translate('page_not_found_message', $lang, $translations); ?></p>
                                </div>
                                <div class="">
                                    <a class="prt-btn prt-btn-size-md prt-btn-shape-round prt-btn-style-fill prt-btn-color-skincolor"
                                        href="/"><?php echo translate('back_to_home', $lang, $translations); ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!--error-404 end-->
        </div>

        @include('components.home.footer')

        <!-- back-to-top start -->
        <a id="totop" href="#top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- back-to-top end -->

    </div>

    <!-- Javascript -->
    <script src="js/jquery-3.6.3.min.js"></script>
    <script src="js/bootstrap.bundle.js"></script>
    <script src="js/aos.js"></script>
    <script src="js/jquery-validate.js"></script>
    <script src="js/jquery.prettyPhoto.js"></script>
    <script src="js/slick.min.js"></script>
    <script src="js/jquery-waypoints.js"></script>
    <script src="js/numinate.min.js"></script>
    <script src="js/imagesloaded.min.js"></script>
    <script src="js/jquery-isotope.js"></script>
    <script src="js/jquery.twentytwenty.js"></script>
    <script src="js/circle-progress.min.js"></script>
    <script src="js/main.js"></script>
</body>

@endsection