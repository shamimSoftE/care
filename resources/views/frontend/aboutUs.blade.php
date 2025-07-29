@extends('layouts.app')

@section('content')

<section id="aboutUs">
    <div class="container">
        <div class="row">
            <div class="col-lg-4">
                <div class="left-content">
                    <div class="title text-center">
                        <h2>Welcome to Apple Gadgets Care</h2>
                    </div>
                    <a href="{{route('contact')}}">Get in touch <span><i class="fa fa-chevron-right"></i></span></a>
                    <div class="images">
                        <div class="img">
                            <img src="{{asset('uploads/images/aboutus/'.$aboutUs->main_image)}}" alt="">
                        </div>
                        <h6>Our Confident Team</h6>
                        <div class="img">
                            <img src="{{asset('uploads/images/aboutus/'.$aboutUs->team_image)}}" alt="">
                        </div>
                        <h6>Top-notch customer assistance</h6>
                        <div class="img">
                            <img src="{{asset('uploads/images/aboutus/'.$aboutUs->service_image)}}" alt="">
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-8">
                <div class="right-content">
                    <div class="title text-center">
                        <h2>Your One-Stop <span>Solution!</span></h2>
                        <p>Your Trusted Apple Repair Service Center in Bangladesh</p>
                    </div>
                    <div class="about-desp">
                        {!! $aboutUs->description !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

@endsection
