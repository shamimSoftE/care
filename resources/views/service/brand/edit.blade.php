@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-end">
                <a href="{{route('service.index.brand')}}" class="btn btn-success mb-1"><i class="mdi mdi-arrow-left"></i> GO BACK</a>
            </div>
            <form action="{{route('service.update.brand')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="id" value="{{$brand->id}}">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="card card-body">
                            <div class="mb-1">
                                <strong class="text-dark">Brand Edit</strong>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Brand Name</label>
                                <input type="text" class="form-control" value="{{$brand->name}}" name="name">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Brand Altertext & Image (85 X 85)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Image Alternative Text" value="{{$brand->imageAlt}}" name="imageAlt">
                                    <label for="TypeImage" class="btn btn-info">CHOOSE IMAGE</label>
                                </div>
                                <input style="display: none;" id="TypeImage" type="file" class="form-control" name="image" oninput="Image.src=window.URL.createObjectURL(this.files[0])" accept="image">
                            </div>
                            <div class="mb-1">
                                @if ($brand->image)
                                <img width="150" id="Image" src="{{asset('/uploads/images/service/'.$brand->image)}}" alt="No Image Entered">
                                @else
                                <img width="150" id="Image" src="{{asset('/uploads/images/service/'.$brand->image)}}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">UPDATE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


