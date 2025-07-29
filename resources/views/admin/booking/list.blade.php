@extends('layouts.dashboard')

@section('content')

<div class="container">
    <ul class="nav nav-pills navtab-bg nav-justified">
        <li class="nav-item">
            <a href="#pending" data-bs-toggle="tab" aria-expanded="false"  class="nav-link bg-warning text-white active">
                Pending List
            </a>
        </li>
        <li class="nav-item">
            <a href="#approve" data-bs-toggle="tab" aria-expanded="true" class="nav-link bg-info text-white">
                Approve List
            </a>
        </li>
        <li class="nav-item">
            <a href="#complete" data-bs-toggle="tab" aria-expanded="false" class="nav-link bg-success text-white">
                Complete List
            </a>
        </li>
        <li class="nav-item">
            <a href="#cancel" data-bs-toggle="tab" aria-expanded="false" class="nav-link bg-danger text-white">
                Cancel List
            </a>
        </li>
        <li class="nav-item">
            <a href="#makebooking" data-bs-toggle="tab" aria-expanded="false" class="nav-link bg-purple text-white">
                Make Booking
            </a>
        </li>
    </ul>
    <div class="tab-content">

        <div class="tab-pane show active" id="pending">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="alert alert-warning">
                        Pending List
                    </div>
                </div>
                @forelse ($pending as $key => $content)
                <div class="col-lg-4">
                    <div class="card card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 20%;">SL</th>
                                <th>{{$key+1}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Name</th>
                                <th>{{$content->name}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Email</th>
                                <th>{{$content->email}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Phone</th>
                                <th>{{$content->phone}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Issue</th>
                                <th>{{$content->issue}}</th>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-lg-6 text-start">
                                <a href="{{route('booking.status',[$content->id,'a'])}}" class="btn btn-info">Approve</a>
                            </div>
                            <div class="col-lg-6 text-end">
                                <a href="{{route('booking.status',[$content->id,'c'])}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-12">
                    <div class="text-center">
                        NO PENDING BOOKING
                    </div>
                </div>
                @endforelse

            </div>
        </div>

        <div class="tab-pane " id="approve">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="alert alert-info">
                        Approve List
                    </div>
                </div>
                @forelse ($approve as $key => $content)
                <div class="col-lg-4">
                    <div class="card card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 20%;">SL</th>
                                <th>{{$key+1}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Name</th>
                                <th>{{$content->name}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Email</th>
                                <th>{{$content->email}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Phone</th>
                                <th>{{$content->phone}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Issue</th>
                                <th>{{$content->issue}}</th>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-lg-4 text-start">
                                <a href="{{route('booking.status',[$content->id,'d'])}}" class="btn btn-success">Complete</a>
                            </div>
                            <div class="col-lg-4 text-start">
                                <a href="{{route('booking.status',[$content->id,'p'])}}" class="btn btn-warning">Pending</a>
                            </div>
                            <div class="col-lg-4 text-end">
                                <a href="{{route('booking.status',[$content->id,'c'])}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-12">
                    <div class="text-center">
                        NO APPROVE BOOKING
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <div class="tab-pane" id="complete">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="alert alert-success">
                        Complete List
                    </div>
                </div>
                @forelse ($complete as $key => $content)
                <div class="col-lg-4">
                    <div class="card card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 20%;">SL</th>
                                <th>{{$key+1}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Name</th>
                                <th>{{$content->name}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Email</th>
                                <th>{{$content->email}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Phone</th>
                                <th>{{$content->phone}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Issue</th>
                                <th>{{$content->issue}}</th>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-lg-4 text-start">
                                <a href="{{route('booking.status',[$content->id,'c'])}}" class="btn btn-danger">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-12">
                    <div class="text-center">
                        NO COMPLETE BOOKING
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <div class="tab-pane" id="cancel">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="alert alert-danger">
                        Cancel List
                    </div>
                </div>
                @forelse ($cancel as $key => $content)
                <div class="col-lg-4">
                    <div class="card card-body">
                        <table class="table table-bordered">
                            <tr>
                                <th style="width: 20%;">SL</th>
                                <th>{{$key+1}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Name</th>
                                <th>{{$content->name}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Email</th>
                                <th>{{$content->email}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Phone</th>
                                <th>{{$content->phone}}</th>
                            </tr>
                            <tr>
                                <th style="width: 20%;">Issue</th>
                                <th>{{$content->issue}}</th>
                            </tr>
                        </table>
                        <div class="row">
                            <div class="col-lg-4 text-start">
                                <a href="{{route('booking.status',[$content->id,'p'])}}" class="btn btn-dark">Revert</a>
                            </div>
                        </div>
                    </div>
                </div>
                @empty
                <div class="col-lg-12">
                    <div class="text-center">
                        NO CANCEL BOOKING
                    </div>
                </div>
                @endforelse
            </div>
        </div>

        <div class="tab-pane" id="makebooking">
            <div class="row mt-2">
                <div class="col-lg-12">
                    <div class="alert alert-purple">
                        Make Booking
                    </div>
                    <div class="card card-body">
                        <form action="{{route('booking.store')}}" method="POST">@csrf
                            <div class="row">
                                <div class="col-lg-4">
                                    <div class="mb-2">
                                        <label for="" class="form-label">Name <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{old('name')}}" name="name">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Email</label>
                                        <input type="text" class="form-control" value="{{old('email')}}" name="email">
                                    </div>
                                    <div class="mb-2">
                                        <label for="" class="form-label">Phone <span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" value="{{old('phone')}}" name="phone">
                                    </div>
                                </div>
                                <div class="col-lg-8">
                                    <div class="mb-2">
                                        <label for="" class="form-label">Issue <span class="text-danger">*</span></label>
                                        <textarea name="issue" id="" class="form-control" rows="8">{{old('issue')}}</textarea>
                                    </div>
                                    <div class="mb-2 text-end">
                                        <button type="submit" class="btn btn-purple">Make Booking</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>

@endsection
