@extends('layouts.dashboard')

@section('content')

<style>
    .card-body {
        padding: 0.5rem 0.5rem;
    }
    .dash i{
        font-size: 42px;
    }
    /* .dropdownParent{
        position: relative;
    } */
    .dropdownParent .dropdownItems{
        background: #fff;
        margin-top: -35px;
    }
</style>
<div class="container">
    <div class="row">

    </div>

    <div class="row">

        <div class="col-lg-6">
            <div class="card card-body text-white bg-success">
                <strong>Hey {{Auth::user()->name}}, Welcome to your dashboard</strong>
            </div>
            <div class="row">
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{route('aboutus.index')}}">
                        <div class="card card-body text-center dash text-success">
                            <i class="mdi mdi-home-floor-a"></i>
                            <span>About Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('slider.index') }}">
                        <div class="card card-body text-center dash text-success">
                            <i class="mdi mdi-image-size-select-actual"></i>
                            <span>Slider Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('service.index') }}">
                        <div class="card card-body text-center dash text-success">
                            <i class="mdi mdi-face-agent"></i>
                            <span>Service Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{route('expvdu.index')}}">
                        <div class="card card-body text-center dash text-success">
                            <i class="mdi mdi-video-box"></i>
                            <span>Experience & Video</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{route('review.index')}}">
                        <div class="card card-body text-center dash text-success">
                            <i class="mdi mdi-message-draw"></i>
                            <span>Review Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{route('faq.index')}}">
                        <div class="card card-body text-center dash text-success">
                            <i class="mdi mdi-head-question-outline"></i>
                            <span>FAQs Entry</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <div class="card card-body text-white bg-dark">
                <strong>Company Profile</strong>
            </div>
            <div class="row">
                <div class="col-6 col-sm-3 col-lg-6">
                    <a href="{{ route('CompanyProfile.index') }}">
                        <div class="card card-body text-center dash text-dark">
                            <i class="mdi mdi-web text-dark"></i>
                            <span class="text-dark">Company Profile</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-6">
                    <a href="{{ route('register') }}">
                        <div class="card card-body text-center text-dark dash">
                            <i class="mdi mdi-account-circle text-dark"></i>
                            <span class="text-dark">Admin User Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-6">
                    <a href="{{ route('userList') }}">
                        <div class="card card-body text-center text-dark dash">
                            <i class="mdi mdi-account-group text-dark"></i>
                            <span class="text-dark">Admin User's</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-6">
                    <a href="{{ route('term_privacy.index') }}">
                        <div class="card card-body text-center text-dark dash">
                            <i class="mdi mdi-note-text-outline text-dark"></i>
                            <span class="text-dark">Term & Privacy Policy</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-2">
            <div class="card card-body text-white bg-info">
                <strong>Notification</strong>
            </div>
            <div class="row">
                <div class="col-6 col-sm-3 col-lg-12">
                    <a href="{{ route('booking.list') }}">
                        <div class="card card-body text-center dash text-info">
                            <i class="mdi mdi-account-clock"></i>
                            <span>Bookings <span class="text-danger">{{ App\Models\ServiceBooking::where('status','p')->count() }}</span></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6"><!-- Service Module -->
            <div class="card card-body text-white bg-primary">
                <strong>Service Module</strong>
            </div>
            <div class="row">
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('service.index.brand') }}">
                        <div class="card card-body text-center dash text-primary">
                            <i class="mdi mdi-alpha-b-circle-outline"></i>
                            <span>Brand Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('service.index.device') }}">
                        <div class="card card-body text-center dash text-primary">
                            <i class="mdi mdi-devices"></i>
                            <span>Device Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('service.index.model') }}">
                        <div class="card card-body text-center dash text-primary">
                            <i class="mdi mdi-progress-wrench"></i>
                            <span>Model Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('service.index.type') }}">
                        <div class="card card-body text-center dash text-primary">
                            <i class="mdi mdi-hammer-wrench"></i>
                            <span>Type Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('service.index.product') }}">
                        <div class="card card-body text-center dash text-primary">
                            <i class="mdi mdi-wrench"></i>
                            <span>Product Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('service.list.product') }}">
                        <div class="card card-body text-center dash text-primary">
                            <i class="mdi mdi-format-list-bulleted-type"></i>
                            <span>Product List</span>
                        </div>
                    </a>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card card-body text-white bg-purple">
                <strong>Blog Module</strong>
            </div>
            <div class="row">
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('categoryEntry') }}">
                        <div class="card card-body text-center dash text-purple">
                            <i class="mdi mdi-view-grid-plus-outline"></i>
                            <span>Category Entry</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('blogEntry') }}">
                        <div class="card card-body text-center dash text-purple">
                            <i class="mdi mdi-post-outline"></i>
                            <span>Post a Blog</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('blogRecords') }}">
                        <div class="card card-body text-center dash text-purple">
                            <i class="mdi mdi-book-search-outline"></i>
                            <span>Blogs Records</span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('schedulePostList') }}">
                        <div class="card card-body text-center dash text-purple">
                            <i class="mdi mdi-book-clock"></i>
                            <span>Schedule Post <span class="text-danger">{{ App\Models\blog::where('type',2)->count() }}</span></span>
                        </div>
                    </a>
                </div>
                <div class="col-6 col-sm-3 col-lg-4">
                    <a href="{{ route('draftPostList') }}">
                        <div class="card card-body text-center dash text-purple">
                            <i class="mdi mdi-file"></i>
                            <span>Draft Post <span class="text-danger">{{ App\Models\blog::where('type',3)->count() }}</span></span>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
