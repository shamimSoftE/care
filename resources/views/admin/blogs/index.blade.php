@extends('layouts.dashboard')
@section('links')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

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
                <h2>Post Blogs</h2>
            </div>
        </div>
        <div class="col-lg-6">
            <div class="py-1 text-end">
                <a href="{{route('blogRecords')}}" class="btn btn-primary">VIEW RECORDS</a>
            </div>
        </div>
    </div>
    <form action="{{route('blogPostStore')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card card-body mb-1">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label for="" class="form-label">Title*</label>
                                <input required type="text" class="form-control" value="{{old('title')}}" name="title">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Category*</label>
                                <div class="input-group">
                                    <select id="category" required class="form-control" name="category">
                                        <option value="">-- Select Category --</option>
                                        @foreach ($category as $cate)
                                            <option {{(old('category') == $cate->id?'selected':'')}} value="{{$cate->id}}">{{$cate->name}}</option>
                                        @endforeach
                                    </select>
                                    <a class="btn btn-info" href="{{route('categoryEntry')}}"><i class="mdi mdi-plus"></i></a>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Date*</label>
                                <input required type="date" class="form-control" value="{{(old('date') != Null?old('date'):date('Y-m-d'))}}" name="date">
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label for="" class="form-label">Slug* (unique)</label>
                                <div class="input-group">
                                    <input style="width:35%; background:#eee;" readonly type="text" class="form-control" value="https://example.com/blogs/">
                                    <input required style="width:65%;" type="text" class="form-control" value="{{old('slug')}}" name="slug">
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label for="" class="form-label">Long Description*</label>
                                <textarea class="textArea" name="long_desp">{{old('long_desp')}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-12">
                            <div class="mb-1">
                                <label for="" class="form-label">Short Description</label>
                                <textarea class="form-control" name="short_desp" id="" cols="10" rows="4">{{old('short_desp')}}</textarea>
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
                                    <input type="text" class="form-control" placeholder="Alter Text" value="" name="imageAlt">
                                    <label for="altImage" class="btn btn-info">CHOOSE IMAGE</label>
                                </div>

                                <input style="display: none;" id="altImage" type="file" class="form-control" value="" name="image" oninput="I.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-2">
                                <img width="100%" height="150px" id="I" src="{{ asset('/uploads/images/blogs/default.jpg') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-body">
                    <div class="mb-1">
                        <label for="" class="form-label">Uploding By</label>
                        <input style="background:#eee;" readonly type="text" class="form-control" value="{{Auth::user()->name}}">
                    </div>
                </div>

                <div class="card card-body">
                    <div class="mb-1">
                        <label for="" class="form-label">Visibility</label>
                        {{-- Radio --}}
                        <div class="form-check">
                            <input type="radio" name="type" checked="checked" value="3" class="form-check-input" id="radiotype3">
                            <label class="form-check-label" for="radiotype3">Draft</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="type" value="2" class="form-check-input" id="radiotype2">
                            <label class="form-check-label" for="radiotype2">Schedule</label>
                        </div>
                        <div class="form-check">
                            <input type="radio" name="type"value="1" class="form-check-input" id="radiotype1">
                            <label class="form-check-label" for="radiotype1">Published</label>
                        </div>
                        {{-- Radio --}}
                        {{-- Value --}}
                        <div id="type2" class="desc mt-2" style="display: none;">
                            <label for="" class="form-label">Publish Date</label>
                            <input type="date" min="{{date("Y-m-d",strtotime(' +1 day'))}}" value="{{date("Y-m-d",strtotime(' +1 day'))}}" class="form-control" id="publishDate" name="publishDate">
                        </div>
                        {{-- Value --}}
                    </div>
                </div>
                <div class="text-end">
                    <button style="width:100%;" type="submit" id="POST_BTN" class="btn text-white btn-warning">DRAFT BLOG</button>
                </div>
            </div>


        </div>
    </form>
</div>

@endsection

@section('script')
    <script>
        $(document).ready(function() {
            $("input[name$='type']").click(function() {
                var test = $(this).val();
                $("div.desc").hide();
                $("#type" + test).hide();
                if(test == 1)
                {
                    $("div.desc").hide();
                    $("#type" + test).show();
                    $("#POST_BTN").text("PUBLISH BLOG");
                    $("#POST_BTN").addClass("btn-primary");
                    $("#POST_BTN").removeClass("btn-success");
                    $("#POST_BTN").removeClass("btn-warning");
                }
                if(test == 2)
                {
                    $("div.desc").hide();
                    $("#type" + test).show();
                    $("#POST_BTN").text("SCHEDULE BLOG");
                    $("#POST_BTN").addClass("btn-success");
                    $("#POST_BTN").removeClass("btn-primary");
                    $("#POST_BTN").removeClass("btn-warning");
                }
                if(test == 3)
                {
                    $("div.desc").hide();
                    $("#type" + test).show();
                    $("#POST_BTN").text("DRAFT BLOG");
                    $("#POST_BTN").addClass("btn-warning");
                    $("#POST_BTN").removeClass("btn-primary");
                    $("#POST_BTN").removeClass("btn-success");
                }
            });
        });
    </script>
@endsection
