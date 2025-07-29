@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-7 m-auto">
            <div class="card">
                <div class="card-body p-4">

                    <div class="text-center mb-4">
                        <h4 class="text-uppercase mt-0 mb-3">Confirm Password</h4>
                        <p class="text-muted mb-0 font-13"> <strong class="text-primary">{{ $user->email }} </strong> Before changing your {{ ($type == 1?"email address":"password") }} confirm your password.</p>
                    </div>

                    <form action="{{ route('userUpdatePassOrMail') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="pass" class="form-label">Password</label>
                            <input class="form-control" type="password" id="pass" name="password" required="" placeholder="Enter your Current Password">
                            <input class="form-control" type="hidden" name="type" value="{{ $type }}">
                            <input class="form-control" type="hidden" name="id" value="{{ $user->id }}">
                        </div>

                        <div class="mb-3 text-center d-grid">
                            <button class="btn btn-primary" type="submit"> Confirm Password </button>
                        </div>
                    </form>

                </div>
            </div> <!-- end card-body -->
        </div>
    </div>
</div>
@endsection
