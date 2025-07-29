@extends('layouts.app')

@section('content')
<section id="slider">
    <div class="container">
        <div class="slider_content">
            @forelse ($slider as $s)
            <div class="slider_item">
                <img class="w-100" src="{{asset('uploads/images/slider/'.$s->image)}}" alt="">
            </div>
            @empty
            <div class="slider_item">
                <img class="w-100" src="{{asset('uploads/images/slider/default.jpg')}}" alt="">
            </div>
            @endforelse
        </div>
    </div>
</section>

<section id="repaire_category">
    <div class="container">
        <div class="row">
            <div class="col-lg-7 m-auto">
                <div class="repaire_category_card card card-body">
                    <div class="row">
                        @foreach ($device as $dev)
                        <div class="col-lg-3 col-6">
                            <a class="rc-items" href="{{route('service_device',$dev->name)}}">
                                <div class="text-center">
                                    <div class="cate-img">
                                        <img src="{{asset('uploads/images/service/'.$dev->image)}}" width="200" height="200"
                                            alt="" sizes="(max-width: 200px) 100vw, 200px">
                                    </div>
                                    <h6>{{$dev->name}}</h6>
                                </div>
                            </a>
                        </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="service">
    <div class="container">
        <div class="row">
            @forelse ($service as $serv)
            <div class="col-lg-4">
                <div class="serv_content">
                    <div class="serv-img">
                        <img src="{{ asset('uploads/images/service/'.$serv->image) }}" alt="">
                    </div>
                    <h6>{{$serv->title}}</h6>
                    <p>{{$serv->description}}</p>
                </div>
            </div>
            @empty
            <div class="col-lg-12 text-center">No Data Found</div>
            @endforelse
        </div>
    </div>
</section>

<section id="service_available">
    <div class="container">
        <div class="section-header-right-border">
            <h2>Services Available</h2>
            <P>Discover and Select the Service that Best Fits Your Needs</P>
        </div>
        <div class="sa-gap"></div>
        <div class="row">
            @foreach ($service_type as $type)
            <div class="col-lg-2 col-6">
                <div class="sa-card">
                    <a href="javascript:void(0)" onclick="search_item('{{$type->name}}', 'post_type')">
                        <div class="sa-img">
                            <img src="{{ asset('uploads/images/service/'.$type->image) }}" alt="">
                        </div>
                        <h6>{{$type->name}}</h6>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="top-notch-repair-service">
    <div class="container">
        <div class="section-header-bottom-border text-center">
            <h2>Experience Top-Notch Repair Service</h2>
            <div class="section-line"></div>
        </div>
        <div class="row">
            <div class="col-lg-8 m-auto">
                <div class="tnrs-content">
                    <div class="tnrs-top-text">
                        <p>
                            {!!  $experience->desp  !!}
                        </p>
                    </div>
                    <div class="tnrs-top-video">
                            {!!  $experience->link  !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="fun-fact">
    <div class="container">
        <div class="fun-fact-card">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="fun-fact-content">
                        <div class="fun-fact-img">
                            <img src="{{ asset('frontend') }}/assets/images/fun_fact/like.png" alt="">
                        </div>
                        <h6><span class="countup_fun">{{$companyInfo->satisfaction}}</span>%</h6>
                        <p>Satisfaction Guaranteed</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="fun-fact-content">
                        <div class="fun-fact-img">
                            <img src="{{ asset('frontend') }}/assets/images/fun_fact/stat2.png" alt="">
                        </div>
                        <h6><span class="countup_fun">{{$companyInfo->experience}}</span></h6>
                        <p>Glory Years in Market</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="fun-fact-content">
                        <div class="fun-fact-img">
                            <img src="{{ asset('frontend') }}/assets/images/fun_fact/stat3.png" alt="">
                        </div>
                        <h6><span class="countup_fun">{{$companyInfo->customers}}</span>+</h6>
                        <p>Happy Customers</p>
                    </div>
                </div>
                <div class="col-lg-3 col-6">
                    <div class="fun-fact-content">
                        <div class="fun-fact-img">
                            <img src="{{ asset('frontend') }}/assets/images/fun_fact/stat4.png" alt="">
                        </div>
                        <h6><span class="countup_fun">{{$companyInfo->repaired}}</span>+</h6>
                        <p>Successfully Repaired</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="happy_customer">
    <div class="container">
        <div class="row">
            <div class="section-header-bottom-border text-center">
                <h2>Hear from Our Customers</h2>
                <div class="section-line"></div>
                <p>Find Out Why Our Repair Services are Rated Top in the Industry.</p>
            </div>
        </div>

        <div class="hc">
            <div class="customer-review-slider row">
                @foreach ($review as $r)
                <div class="customer-review-slider-item col-lg-4">
                    <div class="customer-review-slider-content">
                        <div class="msg">
                            <p>{{$r->review}}</p>
                        </div>
                        <div class="customer">
                            <div class="avatar">
                                <img src="{{ asset('uploads/images/review/'.$r->image) }}" alt="">
                            </div>
                            <div class="info">
                                <h4>{{$r->name}}</h4>
                                <p>{{$r->designation}}</p>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            <div class="ovrly-1"><img src="{{ asset('frontend') }}/assets/images/customer/left.png" alt=""></div>
            <div class="ovrly-2"><img src="{{ asset('frontend') }}/assets/images/customer/right.png" alt=""></div>
        </div>
    </div>
</section>

<section id="blog">
    <div class="container">
        <div class="row">
            <div class="section-header-bottom-border text-left">
                <h2>Stay Updated with Our Blogs</h2>
                <div class="section-line-I"></div>
            </div>
        </div>
        <div class="blog-slider row">
            @foreach ($blog as $b)
            <div class="col-lg-3 blog-slider-items">
                <div class="blog-contents">
                    <a href="{{route('blog_single',$b->slug)}}">
                        <div class="blog-img">
                            <img src="{{ asset('uploads/images/blogs/'.$b->image) }}" alt="">
                        </div>
                        <h2 class="blog-title">{{$b->title}}</h2>
                        <span class="blog-date">{{ \Carbon\Carbon::parse($b->date)->format('F d, Y') }}</span>
                        <div class="blog-line"></div>
                        <div class="blog-short-desp">
                            {{Str::of($b->short_desp)->limit(40)}}
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>

<section id="faqs">
    <div class="container">
        <div class="row">
            <div class="section-header-bottom-border text-center">
                <h2>FAQs</h2>
                <div class="section-line"></div>
            </div>
        </div>
        <div class="row pt-5">
            <div class="col-lg-9">

                <div class="row">
                    <div class="col-lg-4">
                        <div class="faqs-title">
                            <h6>General Questions</h6>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="faqs-contents accordion accordion-flush" id="accordionFlushExample_General">
                            @foreach ($faq->where('type','g') as $f)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$f->id}}"
                                        aria-expanded="false" aria-controls="flush-collapseOne">{{$f->que}}
                                    </button>
                                </h2>
                                <div id="flush-collapseOne{{$f->id}}" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne"
                                    data-bs-parent="#accordionFlushExample_General">
                                    <div class="accordion-body">{{$f->ans}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-lg-4">
                        <div class="faqs-title">
                            <h6>Repairs & Technical</h6>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="faqs-contents accordion accordion-flush" id="accordionFlushExample_Repairs">
                            @foreach ($faq->where('type','r') as $f)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$f->id}}"
                                        aria-expanded="false" aria-controls="flush-collapseOne">{{$f->que}}
                                    </button>
                                </h2>
                                <div id="flush-collapseOne{{$f->id}}" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne"
                                    data-bs-parent="#accordionFlushExample_General">
                                    <div class="accordion-body">{{$f->ans}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <div class="row pt-3">
                    <div class="col-lg-4">
                        <div class="faqs-title">
                            <h6>Nationwide Service</h6>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="faqs-contents accordion accordion-flush" id="accordionFlushExample_Nationwide">
                            @foreach ($faq->where('type','n') as $f)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="flush-headingOne">
                                    <button class="accordion-button collapsed" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#flush-collapseOne{{$f->id}}"
                                        aria-expanded="false" aria-controls="flush-collapseOne">{{$f->que}}
                                    </button>
                                </h2>
                                <div id="flush-collapseOne{{$f->id}}" class="accordion-collapse collapse"
                                    aria-labelledby="flush-headingOne"
                                    data-bs-parent="#accordionFlushExample_General">
                                    <div class="accordion-body">{{$f->ans}}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<section id="description">
    <div class="container">
        <div class="row">
            <div class="section-header-bottom-border text-left">
                <h2>Best Apple Service Center in Bangladesh</h2>
                <div class="section-line-I"></div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="long_desp">
                    {!!$companyInfo->description!!}
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
