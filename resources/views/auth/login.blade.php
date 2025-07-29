<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="utf-8" />
        <title>Log In | {{$companyInfo->name}}</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
        <meta content="Coderthemes" name="author" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="{{asset('/uploads/images/company/'.$companyInfo->favicon)}}">

		<!-- App css -->

		<link href={{ asset("dashboard/assets/css/app.min.css") }} rel="stylesheet" type="text/css" id="app-style" />

		<!-- icons -->
		<link href={{ asset("dashboard/assets/css/icons.min.css") }} rel="stylesheet" type="text/css" />

        <style>
            body{
                background-position: center !important;
                background-repeat: no-repeat !important;
                background-size: cover !important;
            }
        </style>

    </head>

    <body class="loading authentication-bg authentication-bg-pattern" style="background: url('{{asset('uploads/images/admin/login_bg.jpg')}}');">

        <div class="account-pages my-5">
            <div class="container">

                <div class="row justify-content-center">
                    <div class="col-md-5 col-lg-5 col-xl-5 m-auto">
                        <div class="card" style="box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;">
                            <div class="card-body p-4">
                                <div class="text-center mb-2">
                                    <img style="height: 50px" src={{asset('/uploads/images/company/'.$companyInfo->logo)}} alt="" class="mx-auto">
                                </div>

                                <form method="POST" action="{{ route('login') }}">
                                    @csrf
                                    <div class="mb-3">
                                        <label for="login">{{ __('Username, Email, or Phone') }}</label>
                                        <input id="login" type="text" class="form-control @error('login') is-invalid @enderror" name="login" value="{{ old('login') }}" required autofocus>
                                        @error('login')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="mb-3">
                                        <label class="form-label" for="password-input">Password</label>
                                        <div class="position-relative auth-pass-inputgroup mb-3">
                                            <input type="password" class="form-control pe-5 password-input @error('password') is-invalid @enderror" placeholder="Enter password" id="password-input" name="password" required autocomplete="current-password">
                                            @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="mt-4">
                                        <button class="btn btn-success w-100" type="submit">Sign In</button>
                                    </div>

                                </form>
                            </div> <!-- end card-body -->
                        </div>
                        <!-- end card -->

                    </div> <!-- end col -->
                </div>
                <!-- end row -->
            </div>
            <!-- end container -->
        </div>
        <!-- end page -->

        <!-- Vendor -->
        <script src={{ asset("dashboard/assets/libs/jquery/jquery.min.js") }}></script>
        <script src={{ asset("dashboard/assets/libs/bootstrap/js/bootstrap.bundle.min.js") }}></script>
        <script src={{ asset("dashboard/assets/libs/simplebar/simplebar.min.js") }}></script>
        <script src={{ asset("dashboard/assets/libs/node-waves/waves.min.js") }}></script>
        <script src={{ asset("dashboard/assets/libs/waypoints/lib/jquery.waypoints.min.js") }}></script>
        <script src={{ asset("dashboard/assets/libs/jquery.counterup/jquery.counterup.min.js") }}></script>
        <script src={{ asset("dashboard/assets/libs/feather-icons/feather.min.js") }}></script>

        <!-- App js -->
        <script src={{ asset("dashboard/assets/js/app.min.js") }}></script>

    </body>

<!-- Mirrored from coderthemes.com/adminto/layouts/auth-login.html by HTTrack Website Copier/3.x [XR&CO'2014], Thu, 25 Aug 2022 15:33:32 GMT -->
</html>
