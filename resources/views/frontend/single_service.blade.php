@extends('layouts.app')

@section('content')
    <section id="breadcrumb">
        <div class="container">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                    <li class="breadcrumb-item"><a href="{{route('service_device',$product->rel_to_device->name)}}">{{$product->rel_to_device->name}}</a></li>
                </ol>
            </nav>
        </div>
    </section>

    <section id="product_info">
        <div class="container">
            <div class="row mb-5">
                <div class="col-lg-3">
                    <div class="product_img">
                        <img src="{{asset('uploads/images/service/product/'.$product->image)}}" alt="">
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="product_details">
                        <div class="section-header-bottom-border text-left product_title">
                            <h2>{{$product->name}}</h2>
                            <div class="section-line-I"></div>
                        </div>
                        <div class="price">৳ <span>{{$product->price}}</span></div>
                        <div class="text-danger message">Costs can vary with device condition</div>
                        <div class="short_desp">
                            {!!$product->short_desp!!}
                        </div>
                        <div class="contact_btn">
                            <div class="ct-btn whatsapp">
                                <a href="https://wa.me/{{$companyInfo->whatsapp}}"><i class="mdi mdi-whatsapp"></i> Ask in WhatsApp</a>
                            </div>
                            <div class="ct-btn phone">
                                <a href="callto:{{$companyInfo->whatsapp}}"><i class="mdi mdi-phone"></i>  {{$companyInfo->whatsapp}}</a>
                            </div>
                        </div>
                        <div class="share_to">
                            <ul>
                                <li>
                                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(url()->current()) }}" target="_blank">
                                        <i class="fab fa-facebook-f"></i><span>Share On Facebook</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(url()->current()) }}" target="_blank">
                                        <i class="fab fa-twitter"></i><span>Share On Twitter</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="mailto:?subject=Check%20this%20out&body={{ urlencode(url()->current()) }}" target="_blank">
                                        <i class="fa fa-envelope"></i><span>Email To A Friend</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://pinterest.com/pin/create/button/?url={{ urlencode(url()->current()) }}" target="_blank">
                                        <i class="fab fa-pinterest"></i><span>Pin On Pinterest</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(url()->current()) }}" target="_blank">
                                        <i class="fab fa-linkedin"></i><span>Share On Linkedin</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="service-content">
                        <div class="row">
                            @foreach ($service as $serv)
                            <div class="col-lg-12">
                                <div class="service-item d-flex mb-3" style="align-items: center">
                                    <div class="icon">
                                        <img class="w-100" src="{{asset('uploads/images/service/'.$serv->image)}}" alt="">
                                    </div>
                                    <div class="text">
                                        <h6>{{$serv->title}}</h6>
                                        <p>{{$serv->description}}</p>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
            <div class="product_long_desp">
                <div class="row">
                    <div class="col-lg-2 col-sm-2">
                        <h4 class="mb-3">Description</h4>
                    </div>
                    <div class="col-lg-10 col-sm-12">
                        <style>
                            .long_desp {
                                overflow-x: auto;
                                word-wrap: break-word;
                                max-width: 100%;
                                box-sizing: border-box;
                            }
                            .long_desp h1,
                            .long_desp h2,
                            .long_desp h3,
                            .long_desp h4,
                            .long_desp h5,
                            .long_desp h6{
                                display: inline !important;
                            }
                            .long_desp ul{
                                margin: 0 20px;
                            }

                            @media (max-width: 768px) {
                                .long_desp {
                                    overflow-x: hidden;
                                    padding-right: 15px;
                                }
                            }

                        </style>
                        <div class="long_desp" style="width: 100%">
                            {!!$product->long_desp!!}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
