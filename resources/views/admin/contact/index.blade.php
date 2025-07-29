@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="card card-body">
        <form action="{{route('UpdateContactInfo')}}" method="POST">
            @csrf
            <div class="row">
                <strong class="mb-2"><i>Contact Info Entry</i></strong>
                <div class="col-lg-4">
                    <div class="mb-2">
                        <label for="" class="form-label">Address*</label>
                        <input type="text" class="form-control" name="address" value="{{$contactInfo->address}}" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-2">
                        <label for="" class="form-label">Phone*</label>
                        <input type="text" class="form-control" name="phone" value="{{$contactInfo->phone}}" required>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="mb-2">
                        <label for="" class="form-label">Email*</label>
                        <input type="text" class="form-control" name="email" value="{{$contactInfo->email}}" required>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Map*</label>
                        <textarea name="map" id="" cols="30" rows="7" class="form-control">{{$contactInfo->map}}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <label for="" class="form-label">Map View</label><br>
                    <style>
                        iframe{
                            width: 100%;
                            max-width: 100%;
                            height: auto;
                        }
                    </style>
                    {!!$contactInfo->map!!}
                </div>
                <div class="col-lg-12" style="align-self: flex-end">
                    <div class="mb-2 mt-2 text-end">
                        <button type="submit" class="btn btn-purple">UPDATE</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
