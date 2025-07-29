@extends('layouts.app')

@section('content')
<section id="contact_banner" style="background: url('{{asset('frontend/assets/images/contact.jpg')}}')">
    <div class="banner_text">
        <h2>Get in touch</h2>
        <p>Want to get in touch? We’d love to hear from you. Here’s how you can reach us…</p>
        <h4>{{$companyInfo->name}}</h4>
        <p style="margin-bottom: 1.3em;">{{$companyInfo->address}}</p>
        <p>{{$companyInfo->shop_floor}}</p>
    </div>
</section>

<section id="contact_us">
    <div class="container">
        <div class="row contact_us_row">
            <div class="col-lg-6">
                <div class="card">
                    <div class="content">
                        <div class="img">
                            <img src="{{asset('frontend/assets/images/phone.png')}}" alt="">
                        </div>
                        <h6>Talk to sales</h6>
                        <p>Interested in our service? Just pick up the phone and call us.</p>
                        <a href="callto:{{$companyInfo->hotline}}">{{$companyInfo->hotline}}</a>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="content">
                        <div class="img">
                            <img src="{{asset('frontend/assets/images/msg.png')}}" alt="">
                        </div>
                        <h6>Contact support</h6>
                        <p>Sometimes you need a little help. Don’t worry, We’re here for you.</p>
                        <a href="https://www.messenger.com/">Live Chat</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="booking">
    <div class="container">
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="section-header-bottom-border text-center">
                    <h2>Ask a question</h2>
                    <div class="section-line"></div>
                </div>
                <form action="{{route('booking.store')}}" method="POST">@csrf
                    <div class="mb-3">
                        <label for="" class="form-label">Your name</label>
                        <input type="text" class="form-control" value="{{old('name')}}" name="name">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Your Email</label>
                        <input type="text" class="form-control" value="{{old('email')}}" name="email">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Phone Number</label>
                        <input type="text" class="form-control" value="{{old('phone')}}" name="phone">
                    </div>
                    <div class="mb-3">
                        <label for="" class="form-label">Issue Details</label>
                        <textarea name="issue" class="form-control" rows="4">{{old('issue')}}</textarea>
                    </div>
                    <div class="">
                        <button type="submit" class="btn btn-care">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<section id="map">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <style>
                    iframe{ width:100%; height: 450px; }
                </style>
                {!!$companyInfo->map!!}
            </div>
        </div>
    </div>
</section>

@endsection
