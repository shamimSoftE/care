@extends('layouts.dashboard')

@section('content')
@php
    $typeEmail = 1;
    $typePass = 2;
@endphp
<div class="container">
    <div class="row">
        <div class="col-sm-8 m-auto">
            <div class="card">
                <div class="bg-picture card-body">
                    <strong class="text-dark"><p class="mb-2">User Information <span>(Last updated at : {{ ($user_info->updated_at != Null?$user_info->updated_at->format("d-M-y"):$user_info->created_at->format("d-M-y")) }})</span></p></strong>
                    <div
                    style=
                    "
                    width: 100%;
                    height: 100%;
                    text-align: center;
                    display: flex;
                    justify-content: center;
                    "
                    class="m-auto image">
                        <img src="{{( $user_info->image == Null? asset('/uploads/images/users/user.jpg') :asset('/uploads/images/users/'.$user_info->image) )}}"
                            class="flex-shrink-0 rounded-circle avatar-xl img-thumbnail" alt="profile-image">
                    </div>
                    <div class="text-center w-100 mt-1">
                        <strong><a href="{{ route('userPhoto', $user_info->id) }}" class="text-info"> <i class="mdi mdi-pencil-outline me-1"></i> Edit Profile Photo</a></strong>
                    </div>
                    <div class="flex-grow-1 overflow-hidden">
                            <div class="mb-2">
                                <label for="" class="form-label">username*</label>
                                <form action="{{ route('userUpdateUsername') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="username" value="{{ $user_info->username }}">
                                        <input type="hidden" class="form-control" name="id" value="{{ $user_info->id }}">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Name*</label>
                                <form action="{{ route('userUpdateName') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="name" value="{{ $user_info->name }}">
                                        <input type="hidden" class="form-control" name="id" value="{{ $user_info->id }}">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Phone</label>
                                <form action="{{ route('userUpdatePhone') }}" method="POST">
                                    @csrf
                                    <div class="input-group">
                                        <input type="text" class="form-control" name="phone" value="{{ $user_info->phone }}">
                                        <input type="hidden" class="form-control" name="id" value="{{ $user_info->id }}">
                                        <button type="submit" class="btn btn-primary">Update</button>
                                    </div>
                                </form>
                            </div>
                            <div class="mb-2">
                                <label for="" class="form-label">Email</label>
                                <div class="input-group">
                                    <input readonly type="text" class="form-control" value="{{ $user_info->email }}">
                                    <a href="{{ route('userConfirmPassword',[$user_info->id,1]) }}" class="btn btn-success">Change</a>
                                </div>
                            </div>
                            <p class="text-info">Change Password ? <strong class="text-primary"><a href="{{ route('userConfirmPassword',[$user_info->id,2]) }}">Click here</a></strong></p>

                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
