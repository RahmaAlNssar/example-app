<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <link href="https://fonts.googleapis.com/css?family=Rubik:300,400,700|Oswald:400,700" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('frontend/style.css') }}" />

    <script nonce="03c613b9-4d8b-43d3-bc3e-44a1a1c61a3e">
        (function(w, d) {
            ! function(a, e, t, r) {
                a.zarazData = a.zarazData || {};
                a.zarazData.executed = [];
                a.zaraz = {
                    deferred: []
                };
                a.zaraz.q = [];
                a.zaraz._f = function(e) {
                    return function() {
                        var t = Array.prototype.slice.call(arguments);
                        a.zaraz.q.push({
                            m: e,
                            a: t
                        })
                    }
                };
                for (const e of ["track", "set", "ecommerce", "debug"]) a.zaraz[e] = a.zaraz._f(e);
                a.zaraz.init = () => {
                    var t = e.getElementsByTagName(r)[0],
                        z = e.createElement(r),
                        n = e.getElementsByTagName("title")[0];
                    n && (a.zarazData.t = e.getElementsByTagName("title")[0].text);
                    a.zarazData.x = Math.random();
                    a.zarazData.w = a.screen.width;
                    a.zarazData.h = a.screen.height;
                    a.zarazData.j = a.innerHeight;
                    a.zarazData.e = a.innerWidth;
                    a.zarazData.l = a.location.href;
                    a.zarazData.r = e.referrer;
                    a.zarazData.k = a.screen.colorDepth;
                    a.zarazData.n = e.characterSet;
                    a.zarazData.o = (new Date).getTimezoneOffset();
                    a.zarazData.q = [];
                    for (; a.zaraz.q.length;) {
                        const e = a.zaraz.q.shift();
                        a.zarazData.q.push(e)
                    }
                    z.defer = !0;
                    for (const e of [localStorage, sessionStorage]) Object.keys(e || {}).filter((a => a.startsWith(
                        "_zaraz_"))).forEach((t => {
                        try {
                            a.zarazData["z_" + t.slice(7)] = JSON.parse(e.getItem(t))
                        } catch {
                            a.zarazData["z_" + t.slice(7)] = e.getItem(t)
                        }
                    }));
                    z.referrerPolicy = "origin";
                    z.src = "../../cdn-cgi/zaraz/sd0d9.js?z=" + btoa(encodeURIComponent(JSON.stringify(a
                        .zarazData)));
                    t.parentNode.insertBefore(z, t)
                };
                ["complete", "interactive"].includes(e.readyState) ? zaraz.init() : a.addEventListener(
                    "DOMContentLoaded", zaraz.init)
            }(w, d, 0, "script");
        })(window, document);
    </script>

</head>
<!-- CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">

<title>{{ config('app.name', 'Hotel') }}</title>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}" defer></script>

<!-- Fonts -->
<link rel="dns-prefetch" href="//fonts.gstatic.com">
<link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">


<link href="{{ asset('assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
<link
    href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
    rel="stylesheet">


</head>


<body data-spy="scroll" data-target=".site-navbar-target" data-offset="300">

    <!-- Page Wrapper -->


    <div id="overlayer"></div>
    <div class="loader">
        <div class="spinner-border text-primary" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>
    <div class="site-wrap" id="home-section">
        <div class="site-mobile-menu site-navbar-target">
            <div class="site-mobile-menu-header">
                <div class="site-mobile-menu-close mt-3">
                    <span class="icon-close2 js-menu-toggle"></span>
                </div>
            </div>
            <div class="site-mobile-menu-body"></div>
        </div>
      @include('partials.frontend.header')
        <main class="py-4">
            @yield('content')
        </main>
        <footer class="site-footer" style="{{ App::isLocale('ar') ? 'direction:rtl;text-align:right':'direction:ltr;text-align:left' }}">
            <div class="container">
                <div class="row">
                    <div class="col-md-6">
                        <div class="row">
                            <div class="col-md-8">
                                <h2 class="footer-heading mb-4">{{ __('frontend.about') }}</h2>
                                <p>{{ $about->descrption }}.</p>
                            </div>
                            <div class="col-md-4 ml-auto">

                                <ul class="list-unstyled">
                                    <li><a href="#home-section">{{ __('frontend.home') }}</a></li>
                                    <li><a href="#product-section">{{ __('frontend.product') }}</a></li>
                                    <li>
                                        <a href="#about-section">{{ __('frontend.about') }}</a>

                                    </li>
                                    

                                    <li><a href="#contact-section">{{ __('frontend.contact') }}</a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 ml-auto">

                        <h2 class="footer-heading mb-4">{{ __('frontend.follow') }}</h2>
                        <a href="{{ $about->facebook_url }}" class="btn border-w-2 rounded primary-primary-outline--hover"><span
                            class="icon-facebook"></span></a>

                        <a href="{{ $about->insta_url }}" class="btn border-w-2 rounded primary-primary-outline--hover"><span
                            class="icon-instagram"></span></a>
                        </form>
                    </div>
                </div>
                <div class="row pt-5 mt-5 text-center">
                    <div class="col-md-12">
                        <div class="border-top pt-5">
                            @if (App::isLocale('en'))
                            <p class="copyright"><small>

                                Copyright &copy;
                                <script>
                                    document.write(new Date().getFullYear());
                                </script> All rights reserved |
                                by  <a
                                    href="" target="_blank">Alsy</a>

                            </small></p>
                            @else
                            <p class="copyright"><small>

                            جميع الحقوق محفوظه&copy;
                            <script>
                                document.write(new Date().getFullYear());
                            </script>
لدى|إلسي
                            </small></p>
                            @endif

                        </div>

                    </div>
                </div>
            </div>
        </footer>
    </div>
    <script src="{{ asset('frontend/js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('frontend/js/popper2.min.js') }}"></script>
    <script>
        eval(mod_pagespeed_NYdf7STs2K);
    </script>
    <script>
        eval(mod_pagespeed_dQ9_L3JC$g);
    </script>
    <script src="{{ asset('frontend/js/owl2.carousel.min.js') }}"></script>
    <script>
        eval(mod_pagespeed__l9ujNUQ8C);
    </script>
    <script>
        eval(mod_pagespeed_Tfv85fqylh);
    </script>
    <script>
        eval(mod_pagespeed_3Aa_656viP);
    </script>
    <script>
        eval(mod_pagespeed_VVwZ_1KHDF);
    </script>
    <script src="{{ asset('frontend/js/jquery.fancybox.min.js') }}"></script>
    <script>
        eval(mod_pagespeed_hSbHVrfg_Q);
    </script>
    <script>
        eval(mod_pagespeed_jsE007eTC1);
    </script>
    <script>
        eval(mod_pagespeed_NSKn84ObVd);
    </script>
    <script src="{{ asset('frontend/js/main.js') }}"></script>

    <script async src="https://www.googletagmanager.com/gtag/js?id=UA-23581568-13"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'UA-23581568-13');
    </script>
    <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"
        integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw=="
        data-cf-beacon='{"rayId":"7315db676cda73bb","token":"cd0b4b3a733644fc843ef0b185f98241","version":"2022.6.0","si":100}'
        crossorigin="anonymous"></script>
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <script src="{{ asset('backend-assets/custom/js/script.js') }}"></script>
</body>

</html>
