@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-end">
                <a href="{{route('categoryEntry')}}" class="btn btn-success mb-1"><i class="mdi mdi-arrow-left"></i> GO BACK</a>
            </div>
            <form action="{{route('categoryUpdate')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="id" value="{{$category->id}}">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="card card-body">
                            <div class="mb-1">
                                <strong class="text-dark">Category Edi</strong>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Category Name</label>
                                <input type="text" class="form-control" value="{{$category->name}}" name="name">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Category Altertext & Image (600 X 600)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Image Alternative Text" value="{{$category->imageAlt}}" name="imageAlt">
                                    <label for="CategoryImage" class="btn btn-info">CHOOSE IMAGE</label>
                                </div>
                                <input style="display: none;" id="CategoryImage" type="file" class="form-control" name="image" oninput="Image.src=window.URL.createObjectURL(this.files[0])" accept="image">
                            </div>
                            <div class="mb-1">
                                @if ($category->image)
                                <img width="150" id="Image" src="{{asset('/uploads/images/category/'.$category->image)}}" alt="No Image Entered">
                                @else
                                <img width="150" id="Image" src="{{asset('/uploads/images/category/'.$category->image)}}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                    {{-- <div class="col-lg-6">
                        <div class="card card-body">
                            <div class="mb-1">
                                <strong class="text-dark">Search engine optimization</strong>
                                <p class="font-11">Provide information that will help improve the snippet and bring your product to the top of search engines.</p>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Page title</label>
                                <input type="text" class="form-control" value="{{$category->seoTitle}}" name="seoTitle">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Meta description</label>
                                <textarea class="form-control" name="seoDesp" id="" cols="10" rows="3">{{$category->seoDesp}}</textarea>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Keyword</label>
                                <input type="text" class="form-control" value="{{$category->seoKey}}" name="seoKey">
                            </div>
                        </div>
                    </div> --}}
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">UPDATE CATEGORY</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


