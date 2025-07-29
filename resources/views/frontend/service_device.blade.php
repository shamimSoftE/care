@extends('layouts.app')

@section('content')
    <section id="service_device">
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="side-model-bar">
                        <h4>Select Model</h4>
                        <div class="nav flex-column nav-pills me-3" id="v-pills-tab" role="tablist" aria-orientation="vertical">

                            @foreach ($model as $key => $m)
                            <button class="nav-link {{$key == 0?'active':''}}" id="M{{$m->id}}-tab" data-bs-toggle="pill"
                            data-bs-target="#M{{$m->id}}" type="button" role="tab" aria-controls="M{{$m->id}}"
                            aria-selected="{{$key == 0?'true':''}}">{{$m->name}}</button>
                            @endforeach

                        </div>
                    </div>
                </div>
                <div class="col-lg-9">
                    <div class="products-list">
                        <div class="tab-content" id="v-pills-tabContent">

                            @foreach ($model as $key => $m)
                            <div class="product_item_list tab-pane fade {{$key == 0?'show active':''}}" id="M{{$m->id}}" role="tabpanel"
                                aria-labelledby="M{{$m->id}}-tab">
                                <div class="row">
                                    @forelse ($m->rel_to_product as $product)
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
                                        <div class="text-center">
                                            NO PRODUCT FOUND
                                        </div>
                                    </div>
                                    @endforelse
                                </div>
                            </div>
                            @endforeach

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
