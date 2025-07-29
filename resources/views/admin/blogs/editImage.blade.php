@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="card card-body">
                <strong class="text-primary">Edit Blog More Image</strong>
                <form action="{{route('blogImageUpdate')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$blogImage->id}}">
                    <div class="mt-2 mb-1">
                        <label for="" class="form-label mb-1">Old Image</label><br>
                        <img width="100" src="{{asset('/uploads/images/blogs/'.$blogImage->image)}}" alt="Image not found">
                    </div>
                    <div class="mb-1">
                        <label for="" class="form-label mb-1">Upload New Image</label>
                        <input type="file" class="form-control mb-1" name="image" oninput="N.src=window.URL.createObjectURL(this.files[0])">
                        <img id="N" width="200" src="" alt="">
                    </div>
                    <button class="btn btn-secondary">UPDATE</button>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection
