@extends('layouts.dashboard')

@section('content')
<style>
    .ck-editor__editable {min-height: 210px;}
</style>
<div class="container">
    <div class="text-end">
        <a href="{{route('slider.index')}}" class="btn btn-success mb-1"><i class="mdi mdi-arrow-left"></i> GO BACK</a>
    </div>
    <div class="row mb-1">
        <div class="col-lg-12">
            <div class="card card-body">
                <strong class="mb-2">Slider Content</strong>
                <form action="{{route('slider.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$slider->id}}">
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{$slider->title}}">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description" class="textArea">{{$slider->description}}</textarea>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Image <span style="font-weight: 300;" class="text-danger"><i>(1536 x 578)</i></span></label>
                                <input type="file" class="form-control" name="image" value="" oninput="S.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">View Image</label><br>
                                <img id="S" width="100%" height="200px" src="{{asset('uploads/images/slider/'.$slider->image)}}" alt="">
                            </div>
                            <button class="btn btn-primary">UPDATE SLIDER CONTENT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
