<!DOCTYPE html>
<html lang="en">

    <!-- Mirrored from coderthemes.com/adminto/layouts/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Aug 2022 15:31:08 GMT -->
    <head>
        <meta charset="utf-8" />
        <title>{{$companyInfo->name}} | Dashboard</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href={{ asset('/uploads/images/company/'.$companyInfo->favicon) }}>
        @yield('links')
        <!-- Custom Css By Link-Up -->
        <link href={{ asset('dashboard/assets/css/custom.css') }} rel="stylesheet" type="text/css" />
        <!-- SummerNote -->
        <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
        <!-- Select2 -->
        <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
        <!-- App css -->
        <link href={{ asset('dashboard/assets/css/app.min.css') }} rel="stylesheet" type="text/css" id="app-style" />

        <!-- icons -->
        <link href={{ asset('dashboard/assets/css/icons.min.css') }} rel="stylesheet" type="text/css" />
    </head>

    <!-- body start -->
    <body class="loading" data-layout-color="light"  data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>

        <!-- Begin page -->
        <div id="wrapper">


            <!-- Topbar Start -->
            <div class="navbar-custom">
                    <ul class="list-unstyled topnav-menu float-end mb-0 d-flex">
                        {{-- Date --}}
                        <li style="align-self: center; color:#343a40; font-weight:700; margin-right:20px; font-size:16px;">
                            <i class="mdi mdi-calendar-range"></i>
                            <span style="margin-left: 2px;">{{Carbon\Carbon::now()->format('d-M-Y')}}</span>
                        </li>
                        {{-- Time --}}
                        <li style="align-self: center; color:#343a40; font-weight:700; margin-right:20px; font-size:16px;">
                            <i class="mdi mdi-clock-outline"></i>
                            <span style="margin-left: 2px;" id="timer"></span>
                        </li>
                        {{-- Profile --}}
                        <li class="dropdown notification-list topbar-dropdown">
                            <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                                <img src={{( Auth::user()->image == Null? asset('/uploads/images/users/user.jpg') :asset('/uploads/images/users/'.Auth::user()->image) )}} alt="user-image" class="rounded-circle">
                                <span class="pro-user-name ms-1">
                                    {{ Auth::user()->name; }} <i class="mdi mdi-chevron-down"></i>
                                </span>
                            </a>
                            <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                                <!-- item-->
                                <div class="dropdown-header noti-title">
                                    <h6 class="text-overflow m-0">Welcome !</h6>
                                </div>

                                <!-- item-->
                                <a href="{{ route('userAccount', Auth::id()) }}" class="dropdown-item notify-item">
                                    <i class="fe-user"></i>
                                    <span>My Account</span>
                                </a>

                                <div class="dropdown-divider"></div>

                                <!-- item-->
                                <a href="{{ route("logout") }}" class="dropdown-item notify-item" >
                                    <i class="fe-log-out"></i>
                                    <span>Logout</span>
                                </a>
                            </div>
                        </li>
                    </ul>
                    <!-- LOGO -->
                    <div class="logo-box">
                        <a href="{{ route('welcome') }}" class="logo logo-light text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('/uploads/images/company/'.$companyInfo->logo) }}" alt="">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('/uploads/images/company/'.$companyInfo->logo) }}" style="height: 50px" alt="">
                            </span>
                        </a>
                        <a href="{{ route('welcome') }}" class="logo logo-dark text-center">
                            <span class="logo-sm">
                                <img src="{{ asset('/uploads/images/company/'.$companyInfo->logo) }}" alt="">
                            </span>
                            <span class="logo-lg">
                                <img src="{{ asset('/uploads/images/company/'.$companyInfo->logo) }}" style="height: 50px" alt="">
                            </span>
                        </a>
                    </div>

                    <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                        <li>
                            <button class="button-menu-mobile disable-btn waves-effect">
                                <i class="fe-menu"></i>
                            </button>
                        </li>

                        <li>
                            <h4 class="page-title-main">Dashboard</h4>
                        </li>

                    </ul>

                    <div class="clearfix"></div>

            </div>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
            <div class="left-side-menu">

                <div class="h-100" data-simplebar>

                    <!--- Sidemenu -->
                    <div id="sidebar-menu">

                        <ul id="side-menu">

                            <li>
                                <a href="{{ route('home') }}">
                                    <i class="mdi mdi-view-dashboard-outline"></i>
                                    <span> Dashboard </span>
                                </a>
                            </li>

                            <li>
                                <a href="{{route('booking.list')}}">
                                    <i class="mdi mdi-account-clock"></i>
                                    <span> Booking </span>
                                    <span class="badge bg-success rounded-pill float-end">{{ App\Models\ServiceBooking::where('status','p')->count() }}</span>
                                </a>
                            </li>

                            <li>
                                <a href="#adminstrator" data-bs-toggle="collapse">
                                    <i class="   mdi mdi-monitor-dashboard"></i>
                                    <span>Adminstrator</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="adminstrator">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('aboutus.index') }}">
                                                <i class="mdi mdi-home-floor-a"></i>
                                                <span>About Us Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('slider.index') }}">
                                                <i class="mdi mdi-post-outline"></i>
                                                <span>Slider Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('service.index') }}">
                                                <i class="mdi mdi-image-size-select-actual"></i>
                                                <span>Service Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('expvdu.index') }}">
                                                <i class="mdi mdi-video-box"></i>
                                                <span>Experience & Video</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('review.index') }}">
                                                <i class="mdi mdi-message-draw"></i>
                                                <span>Review Entry</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('faq.index') }}">
                                                <i class="mdi mdi-head-question-outline"></i>
                                                <span>FAQs Entry</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#Service" data-bs-toggle="collapse">
                                    <i class="mdi mdi-wrench"></i>
                                    <span>Service Module</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="Service">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('service.index.brand') }}">
                                                <i class="mdi mdi-alpha-b-circle-outline"></i>
                                                <span>Brand Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('service.index.device') }}">
                                                <i class="mdi mdi-devices"></i>
                                                <span>Device Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('service.index.model') }}">
                                                <i class="mdi mdi-progress-wrench"></i>
                                                <span>Model Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('service.index.type') }}">
                                                <i class="mdi mdi-hammer-wrench"></i>
                                                <span>Type Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('service.index.product') }}">
                                                <i class="mdi mdi-wrench"></i>
                                                <span>Product Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('service.list.product') }}">
                                                <i class="mdi mdi-format-list-bulleted-type"></i>
                                                <span>Product List</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#blog" data-bs-toggle="collapse">
                                    <i class="mdi mdi-post-outline"></i>
                                    <span>Blog Module</span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="blog">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('categoryEntry') }}">
                                                <i class="mdi mdi-view-grid-plus-outline"></i>
                                                <span>Category Entry</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('blogEntry') }}">
                                                <i class="mdi mdi-post-outline"></i>
                                                <span>Post a Blog</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('draftPostList') }}">
                                                <i class="mdi mdi-post-outline"></i>
                                                <span>Draft Post List</span>
                                            </a>
                                        </li>
                                        <li>
                                            <a href="{{ route('schedulePostList') }}">
                                                <i class="mdi mdi-post-outline"></i>
                                                <span>Schedule Post List</span>
                                            </a>
                                        </li>

                                        <li>
                                            <a href="{{ route('blogRecords') }}">
                                                <i class="mdi mdi-book-search-outline"></i>
                                                <span>Blogs Records</span>
                                            </a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="#user" data-bs-toggle="collapse">
                                    <i class="mdi mdi-account"></i>
                                    <span> User </span>
                                    <span class="menu-arrow"></span>
                                </a>
                                <div class="collapse" id="user">
                                    <ul class="nav-second-level">
                                        <li>
                                            <a href="{{ route('register') }}">Register User</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('userList') }}">User List</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>

                            <li>
                                <a href="{{ route('CompanyProfile.index') }}">
                                    <i class="mdi mdi-web"></i>
                                    <span> Company Profile </span>
                                </a>
                            </li>

                        </ul>

                    </div>
                    <!-- End Sidebar -->

                    <div class="clearfix"></div>

                </div>
                <!-- Sidebar -left -->

            </div>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    @yield('content')
                    <!-- container-fluid -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <footer class="footer">
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-md-6">
                                <script>document.write(new Date().getFullYear())</script> &copy; Design by <a href="#">Link-up technology ltd</a>
                            </div>
                        </div>
                    </div>
                </footer>
                <!-- end Footer -->

            </div>
            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->



        <!-- Vendor -->
        <script src= {{ asset('dashboard/assets/libs/jquery/jquery.min.js') }}></script>
        <script src= {{ asset('dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}></script>
        <script src= {{ asset('dashboard/assets/libs/simplebar/simplebar.min.js') }}></script>
        <script src= {{ asset('dashboard/assets/libs/node-waves/waves.min.js') }}></script>
        <script src= {{ asset('dashboard/assets/libs/waypoints/lib/jquery.waypoints.min.js') }}></script>
        <script src= {{ asset('dashboard/assets/libs/jquery.counterup/jquery.counterup.min.js') }}></script>
        <script src= {{ asset('dashboard/assets/libs/feather-icons/feather.min.js') }}></script>

        <!-- Vue -->
        <script src= {{ asset('vue/vue.js') }}></script>
        <script src= {{ asset('vue/vuejs-datatable.js') }}></script>
        <script src= {{ asset('vue/vue-select.js') }}></script>
        <script src= {{ asset('vue/vue-google-charts.browser.js') }}></script>
        <script src= {{ asset('vue/moment.js') }}></script>
        <script src= {{ asset('vue/axios.min.js') }}></script>
        <script src= {{ asset('vue/lodash.min.js') }}></script>


        <!-- knob plugin -->
        <script src= {{ asset('dashboard/assets/libs/jquery-knob/jquery.knob.min.js') }}></script>

        <!--Morris Chart-->
        <script src= {{ asset('dashboard/assets/libs/morris.js06/morris.min.js') }}></script>
        <script src= {{ asset('dashboard/assets/libs/raphael/raphael.min.js') }}></script>
        <!-- SummerNote -->
        <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.js"></script>
        <!-- Select2 -->
        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
        <!-- Ckeditor -->
        <script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/super-build/ckeditor.js"></script>
        <!-- Dashboar init js-->
        <script src= {{ asset('dashboard/assets/js/pages/dashboard.init.js') }}></script>
        <!-- Sweet Alert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
        <!-- App js-->
        <script src= {{ asset('dashboard/assets/js/app.min.js') }}></script>

        @yield('script')

        <script>
            $(document).ready(function()
            {
                $('#summernote').summernote();
            });
        </script>

        <script>
            setInterval(function() {
                var currentTime = new Date();
                var currentHours = currentTime.getHours();
                var currentMinutes = currentTime.getMinutes();
                var currentSeconds = currentTime.getSeconds();
                currentMinutes = (currentMinutes < 10 ? "0" : "") + currentMinutes;
                currentSeconds = (currentSeconds < 10 ? "0" : "") + currentSeconds;
                var timeOfDay = currentHours < 12 ? "AM" : "PM";
                currentHours = currentHours > 12 ? currentHours - 12 : currentHours;
                currentHours = currentHours == 0 ? 12 : currentHours;
                var currentTimeString = currentHours + ":" + currentMinutes + ":" + currentSeconds + " " + timeOfDay;
                document.getElementById("timer").innerHTML = currentTimeString;
            }, 1000);
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

        <!-- Delete Alert -->
        <script>
            $(".del").click(function () {
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        var link = $(this).attr("name");
                        window.location.href = link;
                    }
                })
            })
        </script>

        <script>
            document.querySelectorAll('.textArea').forEach(editorElement => {
                    CKEDITOR.ClassicEditor.create(editorElement, {
                    toolbar: {
                        items: [
                            'heading', '|',
                            'bold', 'italic', 'strikethrough', 'underline', '|',
                            'bulletedList', 'numberedList', 'todoList', '|',
                            'undo', 'redo',
                            'fontSize', 'fontColor', 'fontBackgroundColor', 'fontFamily', '|',
                            'alignment', '|',
                        ],
                        shouldNotGroupWhenFull: true
                    },
                    list: {
                        properties: {
                            styles: true,
                            startIndex: true,
                            reversed: true
                        }
                    },
                    heading: {
                        options: [
                            { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                            { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                            { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
                            { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
                            { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
                            { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
                            { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
                        ]
                    },
                    placeholder: 'Description ..',
                    fontFamily: {
                        options: [
                            'default',
                            'Arial, Helvetica, sans-serif',
                            'Courier New, Courier, monospace',
                            'Georgia, serif',
                            'Lucida Sans Unicode, Lucida Grande, sans-serif',
                            'Tahoma, Geneva, sans-serif',
                            'Times New Roman, Times, serif',
                            'Trebuchet MS, Helvetica, sans-serif',
                            'Verdana, Geneva, sans-serif'
                        ],
                        supportAllValues: true
                    },
                    fontSize: {
                        options: [ 10, 12, 14, 'default', 18, 20, 22 ],
                        supportAllValues: true
                    },
                    htmlSupport: {
                        allow: [
                            {
                                name: /.*/,
                                attributes: true,
                                classes: true,
                                styles: true
                            }
                        ]
                    },
                    htmlEmbed: {
                        showPreviews: true
                    },
                    mention: {
                        feeds: [
                            {
                                marker: '@',
                                feed: [
                                    '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                                    '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                                    '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                                    '@sugar', '@sweet', '@topping', '@wafer'
                                ],
                                minimumCharacters: 1
                            }
                        ]
                    },
                    removePlugins: [
                        'AIAssistant',
                        'CKBox',
                        'CKFinder',
                        'EasyImage',
                        'MultiLevelList',
                        'RealTimeCollaborativeComments',
                        'RealTimeCollaborativeTrackChanges',
                        'RealTimeCollaborativeRevisionHistory',
                        'PresenceList',
                        'Comments',
                        'TrackChanges',
                        'TrackChangesData',
                        'RevisionHistory',
                        'Pagination',
                        'WProofreader',
                        'MathType',
                        'SlashCommand',
                        'Template',
                        'DocumentOutline',
                        'FormatPainter',
                        'TableOfContents',
                        'PasteFromOfficeEnhanced',
                        'CaseChange'
                    ]
                });
            });

        </script>

        {{-- <script>
            ClassicEditor
            .create(document.querySelector( '.textArea' ),{
                height: '400px',
                toolbar: {
                    items: [
                        'undo', 'redo',
                        '|', 'heading',
                        '|', 'fontfamily', 'fontsize', 'fontColor', 'fontBackgroundColor',
                        '|', 'bold', 'italic', 'strikethrough', 'subscript', 'superscript', 'code',
                        '-',
                        '|', 'alignment',
                        'link', 'uploadImage', 'blockQuote', 'codeBlock',
                        '|', 'bulletedList', 'numberedList', 'todoList', 'outdent', 'indent'
                    ],
                    shouldNotGroupWhenFull: false
                },
                heading: {
                    options: [
                        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
                        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
                        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' }
                    ]
                }
            })
            .then( editor => {
                    console.log( editor );
            })
            .catch( error => {
                    console.error( error );
            } );
        </script> --}}

    </body>

</html>
