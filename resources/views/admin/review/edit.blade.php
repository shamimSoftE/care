@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="text-end">
        <a href="{{route('review.index')}}" class="btn btn-success mb-1"><i class="mdi mdi-arrow-left"></i> GO BACK</a>
    </div>
    <div class="row mb-1">
        <div class="col-lg-12">
            <div class="card card-body">
                <strong class="mb-2">Review Content</strong>
                <form action="{{route('review.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$review->id}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{$review->name}}">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Designation</label>
                                <input type="text" class="form-control" name="designation" value="{{$review->designation}}">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Review</label>
                                <textarea name="review" class="form-control" rows="4">{{$review->review}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Image <span style="font-weight: 300;" class="text-danger"><i>(120 × 120)</i></span></label>
                                <input type="file" class="form-control" name="image" value="" oninput="S.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">View Image</label><br>
                                <img id="S" width="100" height="95" src="{{asset('uploads/images/review')}}/{{$review->image}}" alt="">
                            </div>
                            <button class="btn btn-dark">UPDATE CONTENT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
