@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="text-end">
                <a href="{{route('service.index.type')}}" class="btn btn-success mb-1"><i class="mdi mdi-arrow-left"></i> GO BACK</a>
            </div>
            <form action="{{route('service.update.type')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <input type="hidden" name="id" value="{{$type->id}}">
                <div class="row">
                    <div class="col-lg-6 m-auto">
                        <div class="card card-body">
                            <div class="mb-1">
                                <strong class="text-dark">Type Edit</strong>
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Type Name</label>
                                <input type="text" class="form-control" value="{{$type->name}}" name="name">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Type Altertext & Image (120 X 120)</label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Image Alternative Text" value="{{$type->imageAlt}}" name="imageAlt">
                                    <label for="TypeImage" class="btn btn-info">CHOOSE IMAGE</label>
                                </div>
                                <input style="display: none;" id="TypeImage" type="file" class="form-control" name="image" oninput="Image.src=window.URL.createObjectURL(this.files[0])" accept="image">
                            </div>
                            <div class="mb-1">
                                @if ($type->image)
                                <img width="150" id="Image" src="{{asset('/uploads/images/service/'.$type->image)}}" alt="No Image Entered">
                                @else
                                <img width="150" id="Image" src="{{asset('/uploads/images/service/'.$type->image)}}" alt="">
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">UPDATE TYPE</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection


