@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-7 m-auto">
            <div class="card">
                <div class="card-body p-4">
                    @if ($type == 1)
                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0 mb-3">Change Email Address</h4>
                        </div>

                        <form action="{{ route('userChangePassOrMail') }}" method="POST">
                            @csrf
                            <input class="form-control" type="hidden" name="type" value="{{ $type }}">
                            <input class="form-control" type="hidden" name="id" value="{{ $user->id }}">

                            <div class="mb-3">
                                <label for="" class="form-label">Old Email Address</label>
                                <input class="form-control" type="email" name="oldemail" readonly value="{{ $user->email }}">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">New Email Address</label>
                                <input class="form-control" type="email" name="newemail" value="" required>
                            </div>

                            <div class="mb-3 text-center d-grid">
                                <button class="btn btn-primary" type="submit">Confirm</button>
                            </div>
                        </form>
                    @else
                        <div class="text-center mb-4">
                            <h4 class="text-uppercase mt-0 mb-3">Change Password</h4>
                        </div>

                        <form action="{{ route('userChangePassOrMail') }}" method="POST">
                            @csrf
                            <input class="form-control" type="hidden" name="type" value="{{ $type }}">
                            <input class="form-control" type="hidden" name="id" value="{{ $user->id }}">

                            <div class="mb-3">
                                <label for="" class="form-label">New Password</label>
                                <input class="form-control" type="password" name="newpass" value="">
                            </div>

                            <div class="mb-3">
                                <label for="" class="form-label">Confirm New Password</label>
                                <input class="form-control" type="password" name="confirmpass" value="" required>
                            </div>

                            <div class="mb-3 text-center d-grid">
                                <button class="btn btn-primary" type="submit">Confirm</button>
                            </div>
                        </form>
                    @endif
                </div>
            </div> <!-- end card-body -->
        </div>
    </div>
</div>
@endsection
