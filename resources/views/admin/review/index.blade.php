@extends('layouts.dashboard')

@section('content')
<style>
    .ck-editor__editable {min-height: 170px;}
</style>
<div class="container">
    <div class="row mb-1">
        <div class="col-lg-12">
            <div class="card card-body">
                <i class="mb-2">Review Content</i>
                <form action="{{route('review.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" value="{{old('name')}}">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Designation</label>
                                <input type="text" class="form-control" name="designation" value="{{old('designation')}}">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Review</label>
                                <textarea name="review" class="form-control" rows="4">{{old('review')}}</textarea>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Image <span style="font-weight: 300;" class="text-danger"><i>(120 × 120)</i></span></label>
                                <input type="file" class="form-control" name="image" value="" oninput="S.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">View Image</label><br>
                                <img id="S" width="100" height="95" src="{{asset('uploads/images/review/user.jpg')}}" alt="">
                            </div>
                            <button class="btn btn-dark">INSERT CONTENT</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>sl.</th>
                            <th>Image</th>
                            <th>Name</th>
                            <th>Designation</th>
                            <th>Review</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($review as $key => $content)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><img width="50" src="{{asset('uploads/images/review/'.$content->image)}}" alt=""></td>
                                <td>{{$content->name}}</td>
                                <td>{{ $content->designation }}</td>
                                <td>{{ $content->review }}</td>
                                <td>
                                    <a class="text-info" href="{{route('review.edit',$content->id)}}"><i class="mdi mdi-pencil"></i></a>
                                    <a style="cursor: pointer;" class="text-danger del" name="{{route('review.delete',$content->id)}}"><i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
