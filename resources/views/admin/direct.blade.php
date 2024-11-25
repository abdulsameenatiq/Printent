
@extends('admin.layout.layout')

@section('content')

<body>
    <div class="page">

        <div class="site-main">
            @include("admin.direct.direct")
        </div>

        <!-- back-to-top start -->
        <a id="totop" href="#top">
            <i class="fa fa-angle-up"></i>
        </a>
        <!-- back-to-top end -->

    </div>

    <!-- Use asset() for all JavaScript file paths -->
    <script src="{{ asset('js/jquery-3.6.3.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap.bundle.js') }}"></script>
    <script src="{{ asset('js/aos.js') }}"></script>
    <script src="{{ asset('js/jquery-validate.js') }}"></script>
    <script src="{{ asset('js/jquery.prettyPhoto.js') }}"></script>
    <script src="{{ asset('js/slick.min.js') }}"></script>
    <script src="{{ asset('js/jquery-waypoints.js') }}"></script>
    <script src="{{ asset('js/numinate.min.js') }}"></script>
    <script src="{{ asset('js/imagesloaded.min.js') }}"></script>
    <script src="{{ asset('js/jquery-isotope.js') }}"></script>
    <script src="{{ asset('js/jquery.twentytwenty.js') }}"></script>
    <script src="{{ asset('js/circle-progress.min.js') }}"></script>
    <script src="{{ asset('js/main.js') }}"></script>

    <!-- Revolution Slider -->
    <script src="{{ asset('revolution/js/revolution.tools.min.js') }}"></script>
    <script src="{{ asset('revolution/js/rs6.min.js') }}"></script>
    <script src="{{ asset('revolution/js/slider.js') }}"></script>

</body>

@endsection
