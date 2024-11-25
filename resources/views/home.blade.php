@extends('components.layout.layout')

@section('content')

<body>
    <div class="page">
        <div class="min-box">
            @include('components.home.navbar')
            @include('components.home.hero')
        </div>

        <div class="site-main">
            @include('components.home.marqee')
            @include('components.home.service')
            @include('components.home.wecreate')
            @include('components.home.portfolio')
            @include('components.home.shipping')
            @include('components.home.category')







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

    <!-- Revolution Slider -->
    <script src='revolution/js/revolution.tools.min.js'></script>
    <script src='revolution/js/rs6.min.js'></script>
    <script src="revolution/js/slider.js"></script>
    <!-- Javascript end-->

</body>
@endsection