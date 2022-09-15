<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>Stelar | Sistem Informasi Kearsipan</title>

    <!-- Mobile Specific Metas
  ================================================== -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge">


    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <!-- PLUGINS CSS STYLE -->
    <link rel="stylesheet" href="{{ asset('assets/landing-page/plugins/bootstrap/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/themify-icons/themify-icons.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/slick/slick.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/slick/slick-theme.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/fancybox/jquery.fancybox.min.css') }}">
    <link rel="stylesheet" href="{{ asset('plugins/aos/aos.css') }}">

    <!-- CUSTOM CSS -->
    <link href="{{ asset('assets/landing-page/css/style.css') }}" rel="stylesheet">

</head>

<body class="body-wrapper" data-spy="scroll" data-target=".privacy-nav">


    <nav class="navbar main-nav navbar-expand-lg px-2 px-sm-0 py-2 py-lg-0">
        <div class="container">
            <a class="navbar-brand" href="index.html"><img src="{{ asset('assets/images/logo.png') }}" alt="logo"
                    class="" style="width: 150px;"></a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="ti-menu"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ml-auto">

                    <li class="nav-item dropdown @@pages d-none">
                        <a class="nav-link dropdown-toggle" href="#" data-toggle="dropdown">Pages
                            <span><i class="ti-angle-down"></i></span>
                        </a>
                        <!-- Dropdown list -->
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item @@team" href="team.html">Team</a></li>
                            <li><a class="dropdown-item @@career" href="career.html">Career</a></li>
                            <li><a class="dropdown-item @@blog" href="blog.html">Blog</a></li>
                            <li><a class="dropdown-item @@blogSingle" href="blog-single.html">Blog
                                    Single</a></li>
                            <li><a class="dropdown-item @@privacy"
                                    href="privacy-policy.html">Privacy</a></li>
                            <li><a class="dropdown-item @@faq" href="FAQ.html">FAQ</a></li>
                            <li><a class="dropdown-item" href="sign-in.html">Sign In</a></li>
                            <li><a class="dropdown-item" href="sign-up.html">Sign Up</a></li>
                            <li><a class="dropdown-item" href="404.html">404</a></li>
                            <li><a class="dropdown-item" href="comming-soon.html">Coming Soon</a></li>

                            <li class="dropdown dropdown-submenu dropleft">
                                <a class="dropdown-item dropdown-toggle" href="#!" id="dropdown0501" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Sub Menu</a>

                                <ul class="dropdown-menu" aria-labelledby="dropdown0501">
                                    <li><a class="dropdown-item" href="index.html">Submenu 21</a></li>
                                    <li><a class="dropdown-item" href="index.html">Submenu 22</a></li>
                                </ul>
                            </li>
                        </ul>
                    </li>
                    <li class="nav-item @@about">
                        <a class="nav-link " href="{{ route('login') }}">Masuk</a>
                    </li>
                    <li class="nav-item @@contact">
                        <a class="nav-link  " href="{{ route('register') }}">Daftar</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!--====================================
=            Hero Section            =
=====================================-->
    <section class="section gradient-banner">
        <div class="shapes-container">
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="1000" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-up" data-aos-duration="1000" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="1000" data-aos-delay="100"></div>
            <div class="shape" data-aos="zoom-in" data-aos-duration="1000" data-aos-delay="300"></div>
            <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-right" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="zoom-out" data-aos-duration="2000" data-aos-delay="500"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="200"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-up" data-aos-duration="500" data-aos-delay="0"></div>
            <div class="shape" data-aos="fade-down" data-aos-duration="500" data-aos-delay="0"></div>
            <div class="shape" data-aos="fade-up-right" data-aos-duration="500" data-aos-delay="100"></div>
            <div class="shape" data-aos="fade-down-left" data-aos-duration="500" data-aos-delay="0"></div>
        </div>
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-6 order-2 order-md-1 text-center text-md-left">
                    <h1 class="text-white font-weight-bold mb-4">Sistem Praktikum Kearsipan</h1>
                    <p class="text-white mb-5">Website pembelajaran untuk memfasilitasi kegiatan praktikum kearsipan
                        yang dikembangkan oleh Prodi S1 Pendidikan Administrasi Perkantoran Universitas Negeri Malang
                    </p>
                    <a href="{{ route('login') }}" class="btn btn-main-md bg-white text-dark">Masuk</a>
                </div>
                <div class="col-md-6 text-center order-1 order-md-2">
                    <img class="img-fluid" src="{{ asset('assets/landing-page/images/Envelope-rafiki.svg') }}"
                        alt="screenshot">
                </div>
            </div>
        </div>
    </section>
    <!--====  End of Hero Section  ====-->




    <!-- To Top -->
    <div class="scroll-top-to">
        <i class="ti-angle-up"></i>
    </div>

    <!-- JAVASCRIPTS -->
    <script src="plugins/jquery/jquery.min.js"></script>
    <script src="plugins/bootstrap/bootstrap.min.js"></script>
    <script src="plugins/slick/slick.min.js"></script>
    <script src="plugins/fancybox/jquery.fancybox.min.js"></script>
    <script src="plugins/syotimer/jquery.syotimer.min.js"></script>
    <script src="plugins/aos/aos.js"></script>
    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g"></script>
    <script src="plugins/google-map/gmap.js"></script>

    <script src="js/script.js"></script>
</body>

</html>
