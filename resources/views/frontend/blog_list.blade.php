@extends('layouts.app')

@section('content')
<section id="blog_content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div id="blog" class="blog_list">
                    <div class="row">
                        @forelse ($blog as $b)
                        <div class="col-lg-6">
                            <div class="blog-contents">
                                <a href="{{route('blog_single',$b->slug)}}">
                                    <div class="blog-img" style="height:250px">
                                        <img class="w-100" height="250px" src="{{ asset('uploads/images/blogs/'.$b->image) }}" alt="">
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
                        @empty
                        <div class="col-lg-12">
                            <div class="text-center">
                                No Blog Found
                            </div>
                        </div>
                        @endforelse
                    </div>
                </div>
            </div>
            <div class="col-lg-3">
                <div class="blog-right-bar">
                    <h6>Search</h6>
                    <div class="search-bar">
                        <input type="text" name="search">
                        <button>Search</button>
                    </div>
                    <h4>Recent Posts</h4>
                    <div class="recently_blog">
                        <ul>
                            @forelse ($recent_blog as $rb)
                            <li><a href="{{route('blog_single',$rb->slug)}}">{{$rb->title}}</a></li>
                            @empty
                            <li>No Blog Found</li>
                            @endforelse
                        </ul>
                    </div>
                    <div class="section-header-bottom-border text-left">
                        <h2>Categories</h2>
                        <div class="section-line-I"></div>
                    </div>
                    <div class="categories">
                        <ul>
                            @forelse ($category as $c)
                            <li><a href="{{route('blog_category',$c->name)}}">{{$c->name}}</a></li>
                            @empty
                            <li>No Blog Found</li>
                            @endforelse
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
