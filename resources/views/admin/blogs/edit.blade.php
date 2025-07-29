@extends('layouts.dashboard')

@section('content')

<style>
    .ck-editor__editable {min-height: 200px;}
    .select2-container--default .select2-selection--multiple .select2-selection__choice__display {padding-left: 15px;}
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:hover, .select2-container--default .select2-selection--multiple .select2-selection__choice__remove:focus{
        background-color: #0004ff;
    }
    .select2-container--default .select2-selection--multiple .select2-selection__choice__remove{
        border-right: none;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-6">
            <div class="py-1">
                <h2>Edit Post Blogs</h2>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="text-end py-1">
                <a href="{{route('blogRecords')}}" class="btn btn-primary">VIEW RECORDS</a>
            </div>
        </div>
    </div>
    <form action="{{route('blogPostUpdate')}}" method="POST" enctype="multipart/form-data">
    @csrf
        <input type="hidden" name="id" value="{{$blog->id}}">
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-body mb-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label for="" class="form-label">Title*</label>
                                <input required type="text" class="form-control" value="{{$blog->title}}" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Category*</label>
                                <div class="input-group">
                                    <select id="category" required class="form-control" name="category">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($category as $cate)
                                            <option {{($blog->category == $cate->id?'selected':'')}} value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-info" href="{{route('categoryEntry')}}"><i class="mdi mdi-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Date*</label>
                                <input required type="date" class="form-control" value="{{$blog->date}}" name="date">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label for="" class="form-label">Slug* (unique)</label>
                                <div class="input-group">
                                    <input style="width:35%; background:#eee;" readonly type="text" class="form-control" value="https://example.com/blogs/">
                                    <input required style="width:65%;" type="text" class="form-control" value="{{$blog->slug}}" name="slug">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label for="" class="form-label">Long Description*</label>
                                <textarea class="textArea" name="long_desp">{!!$blog->long_desp!!}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label for="" class="form-label">Short Description</label>
                                <textarea class="form-control" name="short_desp" id="" cols="10" rows="3">{{$blog->short_desp}}</textarea>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

            <div class="col-lg-4">
                <div class="card card-body">
                    <strong class="text-dark">Upload Image</strong>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-2">
                                <label for="" class="form-label">Main Image (1024 X 576)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Image Alternative Text" value="" name="imageAlt">
                                    <label for="altImage" class="btn btn-info">CHOOSE IMAGE</label>
                                </div>

                                <input style="display: none;" id="altImage" type="file" class="form-control" value="" name="image" oninput="I.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-2">
                                <img width="100%" height="150px" id="I" src="{{ asset('/uploads/images/blogs/'.$blog->image) }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-body">
                    <div class="mb-1">
                        <label for="" class="form-label">Uploding By</label>
                        <input style="background:#eee;" readonly type="text" class="form-control" value="{{$blog->rel_to_user->name}}">
                    </div>
                </div>

                <div class="card card-body">
                    <div class="mb-1">
                        <label for="" class="form-label">Visibility</label>
                        {{-- Radio --}}
                        <div class="form-check">
                            <input type="radio" name="type" {{($blog->type == 3?'checked="checked"':'')}} value="3" class="form-check-input" id="radiotype3">
                            <label class="form-check-label" for="radiotype3">Draft</label>
                        </div>
                        <div class="form-check">
                            <input {{($blog->type == 2?'checked="checked"':'')}} type="radio" name="type" value="2" class="form-check-input" id="radiotype2">
                            <label class="form-check-label" for="radiotype2">Schedule</label>
                        </div>
                        <div class="form-check">
                            <input {{($blog->type == 1?'checked="checked"':'')}} type="radio" name="type"value="1" class="form-check-input" id="radiotype1">
                            <label class="form-check-label" for="radiotype1">Published</label>
                        </div>
                        {{-- Radio --}}
                        {{-- Value --}}
                        <div id="type2" class="desc mt-2" style="display:{{($blog->type == 2?'':'none;')}}" >
                            <label for="" class="form-label">Publish Date</label>
                            <input min="{{date("Y-m-d",strtotime(' +1 day'))}}" value="{{date("Y-m-d",strtotime(' +1 day'))}}" type="date" class="form-control" id="publishDate" value="{{($blog->type == 2?$blog->publishDate:'')}}" name="publishDate">
                        </div>
                        {{-- Value --}}
                    </div>
                </div>
                <button style="width:100%;" type="submit" id="POST_BTN" class="btn text-white btn-primary">UPDATE BLOG</button>
            </div>
        </div>

    </form>

    {{-- <div class="row">
        <strong>More Images</strong>
        @forelse (App\Models\blogImage::where('blog_id',$blog->id)->get() as $img)
        <div class="col-lg-3">
            <img class="img-thumbnail" style="max-width: 100%; width:100%;" src="{{asset('uploads/images/blogs/'.$img->image)}}" alt="{{$img->image}}">
            <div class="mt-1">
                <div class="row">
                    <div class="col-lg-6">
                        <a class="btn btn-info" href="{{route('blogImageEdit',$img->id)}}"><i class="fa fa-pen"></i></a>
                    </div>
                    <div class="col-lg-6 text-end">
                        <button class="btn btn-danger del" name="{{route('blogImageDelete',$img->id)}}"><i class="fa fa-trash"></i></button>
                    </div>
                </div>
            </div>
        </div>
        @empty
        No Image Found
        @endforelse
    </div> --}}
</div>

@endsection

@section('script')
    <script>
        $('#category').change(function(){
            var category_id = $(this).val();

            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $.ajax({
                type : 'POST',
                url  : '/getsubcategory',
                data :{'category_id':category_id},
                success: function(data){
                    $('#getsubcategory').html(data);
                }
            });
        });
    </script>
    <script>
        $(".tags").select2({
            tags: true,
            tokenSeparators: [',', ' ']
        })

        $(document).ready(function() {
            $("input[name$='type']").click(function() {
                var test = $(this).val();
                $("div.desc").hide();
                $("#type" + test).hide();
                if(test == 1)
                {
                    $("div.desc").hide();
                    $("#type" + test).show();
                }
                if(test == 2)
                {
                    $("div.desc").hide();
                    $("#type" + test).show();
                }
                if(test == 3)
                {
                    $("div.desc").hide();
                    $("#type" + test).show();
                }
            });
        });

    </script>
@endsection
