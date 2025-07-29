<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{$companyInfo->name}} || Service center Dhaka, Bangladesh</title>
    <link rel="icon" href="{{ asset('uploads/images/company/'.$companyInfo->favicon) }}">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/slick.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/venobox.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/ionicons.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/libs/animate.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/icons.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/style.css">
    <link rel="stylesheet" href="{{ asset('frontend') }}/assets/css/responsive.css">
</head>

<body>

    <header id="heading">
        <div class="top_bar"></div>
    </header>

    <nav class="navbar navbar-expand-lg navbar-light bg-light main_menu">
        <div class="container">
            <a class="navbar-brand" href="{{route('welcome')}}"><img src="{{ asset('uploads/images/company/'.$companyInfo->logo) }}" alt=""></a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav mb-2 me-3 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="{{route('welcome')}}">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('about')}}">About</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button">
                            Services
                        </a>
                        <ul class="dropdown-menu">
                            @foreach ($device as $dev)
                            <li><a class="dropdown-item" href="{{route('service_device',$dev->name)}}">{{$dev->name}}</a></li>
                            @endforeach
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('list_blog')}}">Blogs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="{{route('contact')}}">Contact</a>
                    </li>

                </ul>
                <form id="search_product" class="d-flex me-auto search_bar">
                    <input id="search_input" class="form-control me-2 menu-search" value="{{isset($_GET['s']) ? $_GET['s']:''}}" type="text" placeholder="What service do you need ?">
                    <button id="search_btn" type="submit"><span class="mdi mdi-magnify"></span></button>
                </form>

                <button onclick="location.href='{{ route('contact') }}';" class="btn btn-sm btn-care rounded-pill" type="button">eRepair</button>
            </div>
        </div>
    </nav>

    @yield('content')

    <footer id="footer">
        <div class="container">
            <div class="contact_us_card">
                <div class="row">
                    <div class="col-lg-6 nopadding">
                        <div class="contact_location">
                            <div class="icon">
                                <img src="{{ asset('frontend') }}/assets/images/location.png" alt="">
                            </div>
                            <div class="content">
                                <h4 style="margin-right: 15px">{{$companyInfo->address}}</h4>
                                <p>{{$companyInfo->shop_floor}}</p>
                                <a href="callto:{{$companyInfo->hotline}}">{{$companyInfo->hotline}}</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6 nopadding">
                        <div class="contact_whatsapp">
                            <div class="icon">
                                <img src="{{ asset('frontend') }}/assets/images/whatsapp-line.png" alt="">
                            </div>
                            <div class="content">
                                <h4>Want to chat first?</h4>
                                <p>Chat with us via WhatsApp.</p>
                                <a href="https://wa.me/{{$companyInfo->whatsapp}}">{{$companyInfo->whatsapp}}</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4">
                    <div class="copyright-txt">
                        <p>© 2024 • Nayontelecomecare.com</p>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="footer-nav">
                        <ul>
                            <li><a href="{{route('welcome')}}">Home</a></li>
                            <li><a href="{{route('privacy')}}">Privacy Policy</a></li>
                            <li><a href="{{route('term')}}">Terms & Conditions</a></li>
                            <li><a href="{{route('contact')}}">Contact</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="social">
                        <ul>
                            <li><a target="_blank" href="{{$companyInfo->facebook}}"><i class="fab fa-facebook-f"></i></a></li>
                            <li><a target="_blank" href="{{$companyInfo->instagram}}"><i class="fab fa-instagram"></i></a></li>
                            <li><a target="_blank" href="{{$companyInfo->tiktok}}"><i class="fab fa-tiktok"></i></a></li>
                            <li><a target="_blank" href="{{$companyInfo->youtube}}"><i class="fab fa-youtube"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <div class="social-fix">
        <a href="https://wa.me/{{$companyInfo->whatsapp}}">
            <img src="{{ asset('frontend') }}/assets/images/social.png" alt="">
        </a>
    </div>

    <!-- ========== PopUp Part Start ========== -->
    <!-- <div class="pop_up">
        <div class="pop_up_content">
            <div class="pop_up_img">
                <img src="assets/images/s1-1.jpg" alt="pop_banner">
                <i class="fas fa-times pop_close"></i>
            </div>
        </div>
    </div> -->
    <!-- ========== PopUp Part Start ========== -->



    <!-- JS link -->
    <script src="{{ asset('frontend') }}/assets/js/jquery-1.12.4.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/2023654590.js" crossorigin="anonymous"></script>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/slick.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/venobox.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/jquery.counterup.min.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/waypoints.min.js"></script>
    <!-- <script src="assets/js/materialdesign.init.js"></script> -->
    <!-- Sweet Alert -->
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <!-- Vendor -->
    <script src="{{ asset('frontend') }}/assets/js/vendor/text-type.js"></script>
    <script src="{{ asset('frontend') }}/assets/js/script.js"></script>

    <script>
        new WOW().init();
    </script>

    <script>
        $('#search_product').on('submit', function(e) {
            e.preventDefault();
            let search_input = $('#search_input').val();
            let search_type = 'post_type';
            search_item(search_input, search_type);
        });

        function search_item(input, type){
            let search_input = input;
            let search_type = type;
            let url = "{{ route('search') }}?" + "s=" + encodeURIComponent(search_input) + "&post_type=" + encodeURIComponent(search_type);
            window.location.href = url;
        }

    </script>

    <script>
        $(document).ready(function() {
            var $socialFix = $('.social-fix');

            function checkIfAtBottom() {
                var scrollPosition = $(window).scrollTop() + $(window).height();
                var documentHeight = $(document).height();

                if (scrollPosition === documentHeight) {
                    $socialFix.hide();
                } else {
                    $socialFix.show();
                }
            }
            $(window).on('scroll', checkIfAtBottom);
            checkIfAtBottom();
        });
    </script>
    <script>
        const Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000,
            timerProgressBar: true,
            didOpen: (toast) => {
            toast.addEventListener('mouseenter', Swal.stopTimer)
            toast.addEventListener('mouseleave', Swal.resumeTimer)
            }
        })
    </script>

    @if (session('success'))
        <script>
        Toast.fire({
            icon: 'success',
            title: '{{ session('success') }}',
        })
        </script>
    @endif

    @if (session('error'))
        <script>
        Toast.fire({
            icon: 'error',
            title: '{{ session('error') }}',
        })
        </script>
    @endif



</body>

</html>
