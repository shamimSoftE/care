@extends('layouts.app')

@section('content')
<section id="search-breadcrumb">
    <div class="container">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="{{route('welcome')}}">Home</a></li>
                <li class="breadcrumb-item"><a href="#"><strong>Brand</strong></a></li>
                <li class="breadcrumb-item"><a href="#"><strong>{{$b->name}}</strong></a></li>
            </ol>
        </nav>
    </div>
</section>

<section id="search">
    <div class="container">
        <div class="row">
            <div class="col-lg-3">
                <div class="sidebar">
                    <div class="section-header-bottom-border text-left">
                        <h2 style="font-size: 1.05em; font-weight: 600; color:#444;text-transform:uppercase">Select Device</h2>
                        <div class="section-line-I"></div>
                    </div>
                    <ul class="device mt-3">
                        @foreach ($device as $d)
                        <li><a href="{{route('service_device',$d->name)}}">{{$d->name}}</a></li>
                        @endforeach
                    </ul>
                    <div class="m-4"></div>
                    <div class="section-header-bottom-border text-left">
                        <h2 style="font-size: 1.05em; font-weight: 600; color:#444;text-transform:uppercase">Select Brand</h2>
                        <div class="section-line-I"></div>
                    </div>
                    <ul class="brand mt-3">
                        @foreach ($brand as $b)
                        <li><a href="{{route('blogs',$b->name)}}">{{$b->name}}</a></li>
                        @endforeach
                    </ul>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="products-list">
                    <div class="row">
                        @forelse ($products as $product)
                        <div class="col-lg-2">
                            <a href="{{route('service_product',$product->slug)}}">
                                <div class="product-item">
                                    <div class="img">
                                        <img src="{{asset('uploads/images/service/product/'.$product->image)}}" alt="">
                                    </div>
                                    <h4>{{$product->name}}</h4>
                                    <button type="button">৳ {{$product->price}}</button>
                                </div>
                            </a>
                        </div>
                        @empty
                        <div class="col-lg-12">
                            <p>No products were found matching your selection.</p>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
