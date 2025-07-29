@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-7 m-auto">
            <div class="card">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h4 class="text-uppercase mt-0 mb-3">User Photos</h4>
                    </div>

                    <form action="{{ route('updateUserPhoto') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="mb-3">
                            <img width="100" src="{{( $user->image == Null? asset('/uploads/images/users/user.jpg') :asset('/uploads/images/users/'.$user->image) )}}" id="pic" />
                        </div>
                        <div class="mb-3">
                            <label for="" class="form-label">User Photo (128 X 128)</label>
                            <input type="hidden" value="{{ $user->id }}" name="id">
                            <input type="file" class="form-control" name="userPhoto" oninput="pic.src=window.URL.createObjectURL(this.files[0])">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>

                </div>
            </div> <!-- end card-body -->
        </div>
    </div>
</div>
@endsection
