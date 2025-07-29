@extends('layouts.app')

@section('content')
<section id="blog_content">
    <div class="container">
        <div class="row">
            <div class="col-lg-9">
                <div class="blog_details">
                    <div class="section-header-bottom-border text-center blog_title">
                        <span>{{ isset($blog->rel_to_category) ? $blog->rel_to_category->name : ''}}</span>
                        <h2>{{$blog->title}}</h2>
                        <div class="section-line"></div>
                        <p>Posted on {{ \Carbon\Carbon::parse($blog->date)->format('F d, Y') }} by {{ isset($blog->rel_to_user) ? $blog->rel_to_user->name: ''  }}</p>
                    </div>
                    <div class="blog_img">
                        <img class="w-100" src="{{asset('uploads/images/blogs/'.$blog->image)}}" alt="">
                    </div>
                    <div class="short_desp">
                        <p>{{$blog->short_desp}}</p>
                    </div>
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
                        {!!$blog->long_desp!!}
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
