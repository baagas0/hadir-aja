<!DOCTYPE html>
<!-- Author: Keenthemes
Product Name: Metronic
Product Version: 8.2.3
Purchase: https://1.envato.market/EA4JP
Website: http://www.keenthemes.com
Contact: support@keenthemes.com
Follow: www.twitter.com/keenthemes
Dribbble: www.dribbble.com/keenthemes
Like: www.facebook.com/keenthemes
License: For each use you must have a valid license purchased only from above link in order to legally use the theme for your project.
-->
<html lang="en">

<head>
    <base href="../../" />
    <title>HadirAja - Presensi menjadi lebih mudah</title>
    <meta charset="utf-8" />
    <meta name="description"
        content="" />
    <meta name="keywords"
        content="" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta property="og:locale" content="en_US" />
    <meta property="og:type" content="article" />
    <meta property="og:title" content="HadirAja - Presensi menjadi lebih mudah" />
    <meta property="og:url" content="https://keenthemes.com/metronic" />
    <meta property="og:site_name" content="Metronic by Keenthemes" />
    <link rel="canonical" href="https://preview.keenthemes.com/metronic8" />
    <link rel="shortcut icon" href="{{ asset('assets/media/logos/favicon hadir aja.png') }}" />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Inter:300,400,500,600,700" />
    <link href="assets/plugins/global/plugins.bundle.css" rel="stylesheet" type="text/css" />
    <link href="assets/css/style.bundle.css" rel="stylesheet" type="text/css" />
    <script>
        // Frame-busting to prevent site from being loaded within a frame without permission (click-jacking) if (window.top != window.self) { window.top.location.replace(window.self.location.href); }
    </script>
</head>

<body id="kt_body" class="app-blank">
    <script>
        var defaultThemeMode = "light";
        var themeMode;
        if (document.documentElement) {
            if (document.documentElement.hasAttribute("data-bs-theme-mode")) {
                themeMode = document.documentElement.getAttribute("data-bs-theme-mode");
            } else {
                if (localStorage.getItem("data-bs-theme") !== null) {
                    themeMode = localStorage.getItem("data-bs-theme");
                } else {
                    themeMode = defaultThemeMode;
                }
            }
            if (themeMode === "system") {
                themeMode = window.matchMedia("(prefers-color-scheme: dark)").matches ? "dark" : "light";
            }
            document.documentElement.setAttribute("data-bs-theme", themeMode);
        }
    </script>
    <div class="d-flex flex-column flex-root" id="kt_app_root">
        <div class="d-flex flex-column flex-lg-row flex-column-fluid stepper stepper-pills stepper-column stepper-multistep"
            id="kt_create_account_stepper">
            <div class="d-flex flex-column flex-lg-row-auto w-lg-350px w-xl-500px">
                <div class="d-flex flex-column position-lg-fixed top-0 bottom-0 w-lg-350px w-xl-500px scroll-y bgi-size-cover bgi-position-center"
                    style="background-image: url(assets/media/misc/auth-bg.png)">
                    <div class="d-flex flex-center py-10 py-lg-20 mt-lg-20">
                        <a href="{{ route('login') }}">
                            {{-- <img alt="Logo" src="assets/media/logos/custom-1.png" class="h-70px" /> --}}
                            <img alt="Logo" src="{{ asset('assets/media/logos/logo veritical black.png') }}" class="h-70px" />
                        </a>
                    </div>
                    <div class="d-flex flex-row-fluid justify-content-center p-10">
                        <div class="stepper-nav">
                            <div class="stepper-item current" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon rounded-3">
                                        <i class="ki-duotone ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">1</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title fs-2">Tingkat Instansi</h3>
                                        <div class="stepper-desc fw-normal">Pilih tingkat instansi anda</div>
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon rounded-3">
                                        <i class="ki-duotone ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">2</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title fs-2">Detail Instansi</h3>
                                        <div class="stepper-desc fw-normal">Lengkapi detail instansi anda</div>
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon">
                                        <i class="ki-duotone ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">3</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title fs-2">Lokasi instansi</h3>
                                        <div class="stepper-desc fw-normal">Sesuaikan pin lokasi instansi anda</div>
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon">
                                        <i class="ki-duotone ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">4</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Jam Masuk</h3>
                                        <div class="stepper-desc fw-normal">Sesuaikan jam masuk pada instansi</div>
                                    </div>
                                </div>
                                <div class="stepper-line h-40px"></div>
                            </div>
                            <div class="stepper-item" data-kt-stepper-element="nav">
                                <div class="stepper-wrapper">
                                    <div class="stepper-icon">
                                        <i class="ki-duotone ki-check fs-2 stepper-check"></i>
                                        <span class="stepper-number">5</span>
                                    </div>
                                    <div class="stepper-label">
                                        <h3 class="stepper-title">Selesai</h3>
                                        <div class="stepper-desc fw-normal">Review data anda</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="d-flex flex-center flex-wrap px-5 py-10">
                        <div class="d-flex fw-normal">
                            <a href="https://keenthemes.com" class="text-success px-5" target="_blank">Terms</a>
                            <a href="https://devs.keenthemes.com" class="text-success px-5" target="_blank">Plans</a>
                            <a href="https://1.envato.market/EA4JP" class="text-success px-5" target="_blank">Contact
                                Us</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="d-flex flex-column flex-lg-row-fluid py-10">
                <div class="d-flex flex-center flex-column flex-column-fluid">
                    <div class="w-lg-650px w-xl-700px p-10 p-lg-15 mx-auto">

                        @php
                            // if (count($errors)) dd($errors[0]);
                        @endphp

                        <div id="errorsContainer">
                            @if (count($errors))
                                <div class="alert alert-danger d-flex align-items-center p-5">
                                    <i class="ki-duotone ki-shield-tick fs-2hx text-danger me-4"><span class="path1"></span><span class="path2"></span></i>
                                    <div class="d-flex flex-column">
                                        <h4 class="mb-1 text-dark">Something Error</h4>
                                        @foreach ($errors->all() as $i => $err)
                                        <span>{{ $i+1 }}. {{ $err }}</span>
                                        @endforeach
                                    </div>
                                </div>

                                <div class="w-100 d-flex flex-column align-items-center jusfity-content-center">
                                    <button class="btn btn-primary" id="fixingButton">Perbaiki</button>
                                </div>
                            @endif
                        </div>

                        <form class="my-auto pb-5 {{ count($errors) ? 'd-none' : '' }}" novalidate="novalidate" id="kt_create_account_form" method="post" action="{{ route('register') }}">
                            @include('auth.signup.tingkat-instansi', [ 'current' => true ])
                            @include('auth.signup.detail-instansi', [ 'current' => false ])
                            @include('auth.signup.lokasi-instansi', [ 'current' => false ])
                            @include('auth.signup.jam-masuk', [ 'current' => false ])
                            @include('auth.signup.review', [ 'current' => false ])

                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        var hostUrl = "assets/";
    </script>
    <script src="{{ asset('assets/plugins/global/plugins.bundle.js') }}"></script>
    <script src="{{ asset('assets/js/scripts.bundle.js') }}"></script>

    <script type="text/javascript" src='https://maps.google.com/maps/api/js?key=AIzaSyArJkzKNSGOGAwtMcsCl6cRlFfAG_dIqmE&libraries=places'></script>
    <script src="{{ asset('assets/js/custom/locationpicker.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/custom/utilities/modals/create-account.js') }}"></script>
</body>

</html>
