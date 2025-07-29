@extends('layouts.dashboard')

@section('content')

<div class="container">
    <div class="card card-body">
        <form action="{{route('expvdu.update')}}" method="POST">@csrf
            <div class="row">
                <div class="text-center mb-2">
                    <h5><i>Experience & Video</i></h5>
                </div>
                <div class="col-lg-6">
                    <div class="mb-1">
                        <label for="" class="form-label">Description*</label>
                        <textarea class="textArea" name="desp">{!!$experienceVideo->desp!!}</textarea>
                    </div>
                    <div class="col-lg-12">
                        <button type="submit" class="btn btn-info">UPDATE</button>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-1">
                        <label for="" class="form-label">Video Link*</label>
                        <textarea class="form-control" rows="8" name="link">{{$experienceVideo->link}}</textarea>
                    </div>
                    <style>
                        .video iframe{
                            width: 100%;
                        }
                    </style>
                    <div class="video">
                        {!!$experienceVideo->link!!}
                    </div>
                </div>

            </div>
        </form>
    </div>
</div>

@endsection
