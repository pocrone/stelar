<!DOCTYPE html>
<html lang="en">

<head>

    <!-- Basic Page Needs
  ================================================== -->
    <meta charset="utf-8">
    <title>DAFTAR | STELAR</title>

    <!-- Mobile Specific Metas
  ================================================== -->

    <!-- Favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="images/favicon.png" />

    <!-- PLUGINS CSS STYLE -->
    < <link rel="stylesheet" href="{{ asset('assets/landing-page/plugins/bootstrap/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/landing-page/plugins/themify-icons/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/landing-page/plugins/slick/slick.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/landing-page/plugins/slick/slick-theme.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/landing-page/plugins/fancybox/jquery.fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/landing-page/plugins/aos/aos.css') }}">

        <!-- CUSTOM CSS -->
        <link href="{{ asset('assets/landing-page/css/style.css') }}" rel="stylesheet">

</head>

<body class="body-wrapper" data-spy="scroll" data-target=".privacy-nav">

    <!--=============================
=            Sign Up            =
==============================-->

    <section class="user-login section">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="block">
                        <!-- Image -->
                        <div class="image align-self-center"><img class="img-fluid"
                                src="{{ asset('assets/landing-page/images/Login/student-ga725c3526_1920.jpg') }}"
                                alt="desk-image">
                        </div>
                        <!-- Content -->
                        <div class="content text-center">
                            <div class="logo mb-0">
                                <a href="index.html"><img src="{{ asset('assets/landing-page/images/logos.png') }}"
                                        style="width: 150px;" alt=""></a>
                            </div>
                            <div class="title-text">
                                <h3>Buat Akun ARSIPEDIA</h3>
                            </div>
                            <form action="{{ route('register') }}" method="POST">
                                @csrf
                                <!-- Username -->
                                <input class="form-control main" type="text" name="name"
                                    placeholder="Nama Lengkap" required>
                                <!-- Email -->
                                <input class="form-control main" type="email" name="email"
                                    placeholder="Alamat E-mail" required>
                                <!-- Password -->
                                <select name="role" id="" class="form-control main">
                                    <option value=""> --Daftar sebagai-- </option>
                                    <option value="2"> Siswa </option>
                                    <option value="1"> Guru </option>
                                </select>
                                <input class="form-control main" type="password" name='password' placeholder="Password"
                                    required>
                                <input class="form-control main" type="password" name='password_confirmation'
                                    placeholder="Konfirmasi Password" required>
                                <!-- Submit Button -->
                                <button class="btn btn-main-md">daftar</button>
                            </form>
                            <div class="new-acount">

                                <p>Sudah punya akun? <a href="sign-in.html">MASUK</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!--====  End of Sign Up  ====-->


    <!-- To Top -->
    <div class="scroll-top-to">
        <i class="ti-angle-up"></i>
    </div>

    <!-- JAVASCRIPTS -->
    <script src="{{ asset('assets/landing-page/plugins/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/plugins/bootstrap/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/plugins/slick/slick.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/plugins/fancybox/jquery.fancybox.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/plugins/syotimer/jquery.syotimer.min.js') }}"></script>
    <script src="{{ asset('assets/landing-page/plugins/aos/aos.js') }}"></script>
    <!-- google map -->
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAgeuuDfRlweIs7D6uo4wdIHVvJ0LonQ6g"></script>
    {{-- <script src="plugins/google-map/gmap.js"></script> --}}

    <script src="{{ asset('assets/landing-page/js/script.js') }}"></script>
</body>

</html>
