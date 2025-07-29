@extends('layouts.dashboard')

@section('content')
<style>
    .ck-editor__editable {min-height: 170px;}
</style>
<div class="container">
    <div class="row mb-1">
        <div class="col-lg-12">
            <div class="card card-body">
                <i class="mb-2">Slider Content</i>
                <form action="{{route('slider.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        {{-- <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Title</label>
                                <input type="text" class="form-control" name="title" value="{{old('title')}}">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">Description</label>
                                <textarea name="description" class="textArea">{{old('description')}}</textarea>
                            </div>
                        </div> --}}
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Image <span style="font-weight: 300;" class="text-danger"><i>(1536 x 578)</i></span></label>
                                <input type="file" class="form-control" name="image" value="" oninput="S.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-1">
                                <label for="" class="form-label">View Image</label><br>
                                <img id="S" width="100%" height="200px" src="{{asset('uploads/images/slider/default.jpg')}}" alt="">
                            </div>
                            <button class="btn btn-dark">INSERT SLIDER CONTENT</button>
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
                            {{-- <th>Title</th> --}}
                            {{-- <th>Description</th> --}}
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($slider as $key => $content)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td><img width="150" height="70" src="{{asset('uploads/images/slider/'.$content->image)}}" alt=""></td>
                                {{-- <td>{{$content->title}}</td> --}}
                                {{-- <td>{!!$content->description!!}</td> --}}
                                <td>
                                    <a class="text-info" href="{{route('slider.edit',$content->id)}}"><i class="mdi mdi-pencil"></i></a>
                                    <a style="cursor: pointer;" class="text-danger del" name="{{route('slider.delete',$content->id)}}"><i class="mdi mdi-delete"></i></a>
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
