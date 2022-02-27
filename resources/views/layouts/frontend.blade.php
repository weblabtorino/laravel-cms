<!doctype html>
<html lang="{{ config('app.locale') }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">

    <title>{{ config('app.name', 'CMS - Laravel') }}</title>


{{--    <meta name="description"--}}
{{--          content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">--}}
{{--    <meta name="author" content="pixelcave">--}}
{{--    <meta name="robots" content="noindex, nofollow">--}}

{{--    <!-- Open Graph Meta -->--}}
{{--    <meta property="og:title" content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework">--}}
{{--    <meta property="og:site_name" content="Codebase">--}}
{{--    <meta property="og:description"--}}
{{--          content="Codebase - Bootstrap 5 Admin Template &amp; UI Framework created by pixelcave and published on Themeforest">--}}
{{--    <meta property="og:type" content="website">--}}
{{--    <meta property="og:url" content="">--}}
{{--    <meta property="og:image" content="">--}}

    <!-- Icons -->
    <link rel="shortcut icon" href="{{ asset('frontend/media/favicons/favicon.png') }}">
    <link rel="icon" sizes="192x192" type="image/png"
          href="{{ asset('frontend/media/favicons/favicon-192x192.png') }}">
    <link rel="apple-touch-icon" sizes="180x180"
          href="{{ asset('frontend/media/favicons/apple-touch-icon-180x180.png') }}">

    <link rel="stylesheet" id="css-main" href="{{ asset('frontend/css/codebase.css') }}">


{{--  Home page   --}}
<!-- Google Fonts -->
    <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Dosis:200,300,400,500,600,700,800" rel="stylesheet">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="{{ asset('frontend/css/assets/bootstrap.min.css')}}">
    <!-- Fontawesome Icon -->
    <link rel="stylesheet" href="{{ asset('frontend/css/assets/font-awesome.min.css')}}">
    <!-- Animate Css -->
    <link rel="stylesheet" href="{{ asset('frontend/css/assets/animate.css')}}">
    <!-- Owl Slider -->
    <link rel="stylesheet" href="{{ asset('frontend/css/assets/owl.carousel.min.css')}}">
    <!-- Date Picker -->
    <link rel="stylesheet" href="{{ asset('frontend/css/assets/tempusdominus-bootstrap-4.min.css')}}">
    <!-- Magnific PopUp -->
    <link rel="stylesheet" href="{{ asset('frontend/css/assets/magnific-popup.css')}}">    <!-- Custom Style -->
    <link rel="stylesheet" href="{{ asset('frontend/css/assets/normalize.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/style.css')}}">
    <link rel="stylesheet" href="{{ asset('frontend/css/assets/responsive.css')}}">

{{--    @trixassets--}}
{{--@livewireStyles--}}
@yield('css_after')

<!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Scripts -->
    <script>
        window.Laravel = {!! json_encode(['csrfToken' => csrf_token()]) !!};
    </script>
</head>

<body>
<!-- Preloader -->
<div id="preloader">
    <div class="pr-circle">
        <div class="pr-circle1 pr-child"></div>
    </div>
</div>
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-12">
                <a href=""><img class="img-fluid" src="frontend/images/site-image/striscia.jpg"></a>
            </div>
        </div>
    </div>
</section>

{{--Desktop Web View--}}
<section class="logo-area menu-sticky">
    <div class="container-fluid">
        <div class="row">
            <div class="col-md-9">
                <div class="main-menu text-right">
                    <ul class="list-unstyled list-inline">
                    @foreach( $sideBarLinks as $item )
                            <li class="list-inline-item"><a href="{{ url('/'.$item->slug) }}" class="font-bold text-uppercase">{{ $item->label }}</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<div id="page-container" class="main-content-boxed">
    <!-- Main Container -->
    <main id="main-container">
        {{ $slot }}
    </main>
</div>
<footer>
    <div class="container">
        <div class="row text-left">
            <div class="col-md-3">
                <div class="findus">
                    <h4>Find Us</h4>
                    <p>Lorem ipsum dolor sit amet, consectet adipisicing elit. Saepe porro neque a nam nulla quos
                        atque.</p>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-map-marker"></i>795 South Park Avenue, CA 94107</li>
                        <li><i class="fa fa-envelope"></i>enquery@domain.com</li>
                        <li><i class="fa fa-phone"></i>+1 908 875 7678</li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="qlink">
                    <h4>Quick Links</h4>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-angle-right"></i><a href="">Generel Information</a></li>
                        <li><i class="fa fa-angle-right"></i><a href="">Blood Bank</a></li>
                        <li><i class="fa fa-angle-right"></i><a href="">Medical Research</a></li>
                        <li><i class="fa fa-angle-right"></i><a href="">Emergency Service</a></li>
                        <li><i class="fa fa-angle-right"></i><a href="">Ambulance</a></li>
                        <li><i class="fa fa-angle-right"></i><a href="">Easy Payment</a></li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="tpost">
                    <h4>Latest Posts</h4>
                    <ul class="list-unstyled">
                        <li><i class="fa fa-twitter"></i>Lorem ipsum dolor sit amet, consec... <a href="">https://bh.com/</a>
                        </li>
                        <li><i class="fa fa-twitter"></i>Lorem ipsum dolor sit amet, consec... <a href="">https://bh.com/</a>
                        </li>
                        <li><i class="fa fa-twitter"></i>Lorem ipsum dolor sit amet, consec... <a href="">https://bh.com/</a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-md-3">
                <div class="newsletter">
                    <h4>Newsletter</h4>
                    <form action="#">
                        <input type="text" name="name" placeholder="Your Name" required>
                        <input type="text" name="email" placeholder="Your Email" required>
                        <button type="submit">Register</button>
                    </form>
                </div>
            </div>
            <div class="col-md-12">
                <div class="f-menu text-center">
                    <ul class="menu list-unstyled list-inline">
                        <li class="list-inline-item"><a href="">Home</a></li>
                        <li class="list-inline-item"><a href="">About</a></li>
                        <li class="list-inline-item"><a href="">Service</a></li>
                        <li class="list-inline-item"><a href="">Doctor</a></li>
                        <li class="list-inline-item"><a href="">Blog</a></li>
                        <li class="list-inline-item"><a href="">Contact</a></li>
                    </ul>
                    <p>Copyright &copy; 2017 | Designed With <i class="fa fa-heart"></i> by <a href="#"
                                                                                               target="_blank">SnazzyTheme</a>
                    </p>
                    <ul class="social list-unstyled list-inline">
                        <li class="list-inline-item"><a href=""><i class="fa fa-facebook"></i></a></li>
                        <li class="list-inline-item"><a href=""><i class="fa fa-twitter"></i></a></li>
                        <li class="list-inline-item"><a href=""><i class="fa fa-linkedin"></i></a></li>
                        <li class="list-inline-item"><a href=""><i class="fa fa-youtube"></i></a></li>
                        <li class="list-inline-item"><a href=""><i class="fa fa-pinterest"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</footer>
<!-- END Page Container -->

<!-- Codebase Core JS -->
<script src="{{ asset('frontend/js/codebase.app.js') }}"></script>

<!-- Laravel Original JS -->
<script src="{{ asset('frontend/js/laravel.app.js') }}"></script>
<!-- jQuery JS -->
<script src="{{ asset('frontend/js/assets/vendor/jquery-1.12.4.min.js')}}"></script>

<!-- Bootstrap -->
<script src="{{ asset('frontend/js/assets/popper.min.js')}}"></script>
<script src="{{ asset('frontend/js/assets/bootstrap.min.js')}}"></script>

<!-- Wow Animation -->
<script src="{{ asset('frontend/js/assets/wow.min.js')}}"></script>

<!-- Owl Slider -->
<script src="{{ asset('frontend/js/assets/owl.carousel.min.js')}}"></script>

<!-- Date Picker -->
<script src="{{ asset('frontend/js/assets/moment.min.js')}}"></script>
<script src="{{ asset('frontend/js/assets/tempusdominus-bootstrap-4.min.js')}}"></script>

<!-- Isotope -->
<script src="{{ asset('frontend/js/assets/isotope.pkgd.min.js')}}"></script>

<!-- Magnific PopUp -->
<script src="{{ asset('frontend/js/assets/magnific-popup.min.js')}}"></script>

<!-- Counter Up -->
<script src="{{ asset('frontend/js/assets/counterup.min.js')}}"></script>
<script src="{{ asset('frontend/js/assets/waypoints.min.js')}}"></script>

<!-- Smooth Scroll -->
<script src="{{ asset('frontend/js/assets/smooth-scroll.js')}}"></script>

<!-- Syotimer -->
<script src="{{ asset('frontend/js/assets/jquery.syotimer.min.js')}}"></script>

<!-- Mean Menu -->
<script src="{{ asset('frontend/js/assets/jquery.meanmenu.min.js')}}"></script>

<!-- Form Validation -->
<script src="{{ asset('frontend/js/assets/form.js')}}"></script>

<!-- Custom JS -->
<script src="{{ asset('frontend/js/plugins.js')}}"></script>
<script src="{{ asset('frontend/js/custom.js')}}"></script>

@yield('js_after')
@stack('modals')

@livewireScripts
</body>

</html>
