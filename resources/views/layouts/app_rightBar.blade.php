<!-- sidebar   -->
<div class="sidebar-content fl-wrap">
    <!-- NEWS box-widget -->
    {{-- <div class="box-widget fl-wrap">
        <div class="box-widget-content">
            <div class="news">
                <div class="logo">
                    <img style="width: 100%; max-width: 100%;" src="images/hatil.png" alt="">
                </div>
                <p>HATIL furniture is renowned for its quality craftsmanship, modern designs, and broad product range, gaining popularity both locally and globally for its stylish and functional pieces.</p>
                <ul>
                    <li><a href="#"><i class="fab fa-facebook"></i></a></li>
                    <li><a href="#"><i class="fab fa-instagram"></i></a></li>
                    <li><a href="#"><i class="fab fa-pinterest"></i></a></li>
                </ul>
            </div>
        </div>
    </div> --}}
    <!-- box-widget  end -->
    <!-- RECENT AND FEATURE POST box-widget -->
    <div class="box-widget fl-wrap">
        <div class="box-widget-content">
            <!-- content-tabs-wrap -->
            <div class="content-tabs-wrap tabs-act tabs-widget fl-wrap">
                <div class="content-tabs fl-wrap">
                    <ul class="tabs-menu fl-wrap no-list-style">
                        <li class="current"><a href="#tab-popular">Featured Posts</a></li>
                        <li><a href="#tab-resent">Resent Posts</a></li>
                    </ul>
                </div>
                <!--tabs -->
                <div class="tabs-container">
                    <!--tab -->
                    <div class="tab">
                        <div id="tab-popular" class="tab-content first-tab">
                            <div class="post-widget-container fl-wrap">
                                @foreach (App\Models\blog::where('type',1)->where('feature',1)->take(5)->get() as $blog)
                                <!-- post-widget-item -->
                                <div class="post-widget-item fl-wrap">
                                    <div class="post-widget-item-media">
                                        <a href="{{route('details',$blog->slug)}}"><img src="{{asset('/uploads/images/blogs/'.$blog->image)}}"  alt="{{$blog->imageAlt}}"></a>
                                    </div>
                                    <div class="post-widget-item-content">
                                        <h4><a href="{{route('details',$blog->slug)}}">{{$blog->title}}</a></h4>
                                        <ul class="pwic_opt">
                                            <li><span><i class="far fa-clock"></i> {{$blog->date}}</span></li>
                                            <li>By <span>{{$blog->rel_to_user->name}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--tab  end-->
                    <!--tab -->
                    <div class="tab">
                        <div id="tab-resent" class="tab-content">
                            <div class="post-widget-container fl-wrap">
                                @foreach (App\Models\blog::latest()->where('type',1)->take(5)->get() as $blog)
                                <!-- post-widget-item -->
                                <div class="post-widget-item fl-wrap">
                                    <div class="post-widget-item-media">
                                        <a href="{{route('details',$blog->slug)}}"><img src="{{asset('/uploads/images/blogs/'.$blog->image)}}"  alt="{{$blog->imageAlt}}"></a>
                                    </div>
                                    <div class="post-widget-item-content">
                                        <h4><a href="{{route('details',$blog->slug)}}">{{$blog->title}}</a></h4>
                                        <ul class="pwic_opt">
                                            <li><span><i class="far fa-clock"></i> {{$blog->date}}</span></li>
                                            <li>By <span>{{$blog->rel_to_user->name}}</span></li>
                                        </ul>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <!--tab end-->
                </div>
                <!--tabs end-->
            </div>
            <!-- content-tabs-wrap end -->
        </div>
    </div>
    <!-- box-widget  end -->
    <!-- CATEGORY box-widget -->
    <div class="box-widget fl-wrap">
        <div class="widget-title">Explore Category</div>
        <div class="box-widget-content">
            <div class="tags-widget">
                @foreach (App\Models\category::where('id','!=',1)->get() as $content)
                <a href="{{route('blogCategories',$content->name)}}">{{$content->name}}</a>
                @endforeach
            </div>
        </div>
    </div>
    <!-- box-widget  end -->
    <!-- Gallery box-widget -->
    <div class="box-widget fl-wrap">
        <div class="widget-title">Photo Gallery</div>
        <div class="box-widget-content">
            <div class="row custom-row">
                @php
                    $photos = App\Models\photoGallery::latest()->take(12)->get();
                @endphp
                @foreach ($photos as $pic)
                <div class="col-sm-3 col-lg-3 custom-col">
                    <div class="img" style="margin: 5px 0">
                        <a href="{{asset('/uploads/images/gallery/'.$pic->image)}}" data-fancybox="gallery" data-caption="Photo Album">
                            <img style="width:100%; max-width:100%;" src="{{asset('/uploads/images/gallery/'.$pic->image)}}" alt="{{$pic->image}}">
                        </a>
                    </div>
                </div>
                @endforeach
            </div>
            {{-- <div style="margin:5px 0; text-align:start;">
                <a href="#">See More</a>
            </div> --}}
        </div>
    </div>
    <!-- box-widget  end -->
    <!-- VIDEO box-widget -->
    <div id="right_bar_offset" class="box-widget fl-wrap">
        <div class="widget-title">Videos</div>
        <div class="box-widget-content">
            <style>
                iframe{width: 100%;}
            </style>
            @foreach (App\Models\videoGallery::latest()->take(3)->get() as $vdu)
            <div class="grid-post-item fl-wrap video_grid" style="margin-bottom: 10px;">
                {!!$vdu->link!!}
            </div>
            <div class="video_title" style="text-align: start">
                <h6>{{$vdu->title}}</h6>
            </div>
            @endforeach
        </div>
    </div>
    <!-- box-widget  end -->
</div>
<!-- sidebar  end -->
