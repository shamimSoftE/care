@extends('layouts.dashboard')

@section('content')
    <form action="{{route('aboutus.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row">
                <div class="text-start">
                    <strong><i>About Us Entry</i></strong>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-1">
                                    <label for="" class="form-label">Main Image (770 X 430)</label>
                                    <input type="file" class="form-control" name="main_image" oninput="M.src=window.URL.createObjectURL(this.files[0])">
                                    <img id="M" style="width: 100%; height:180px" src="{{asset('/uploads/images/aboutus/'.$aboutUs->main_image)}}" alt="main_image">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-1">
                                    <label for="" class="form-label">Team Image (770 X 430)</label>
                                    <input type="file" class="form-control" name="team_image" oninput="T.src=window.URL.createObjectURL(this.files[0])">
                                    <img id="T" style="width: 100%; height:180px" src="{{asset('/uploads/images/aboutus/'.$aboutUs->team_image)}}" alt="team_image">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-1">
                                    <label for="" class="form-label">Service Image (770 X 430)</label>
                                    <input type="file" class="form-control" name="service_image" oninput="S.src=window.URL.createObjectURL(this.files[0])">
                                    <img id="S" style="width: 100%; height:180px" src="{{asset('/uploads/images/aboutus/'.$aboutUs->service_image)}}" alt="service_image">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="" class="form-label">Description*</label>
                                    <textarea name="description" class="textArea">{!!$aboutUs->description!!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="mb-2 mt-2 text-end">
                        <button type="submit" class="btn btn-purple">UPDATE</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
