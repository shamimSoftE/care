@extends('layouts.dashboard')

@section('content')
    <form action="{{route('term_privacy.update')}}" method="POST">
        @csrf
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Term & Condition*</label>
                        <textarea name="term" class="textArea">{!!$TermAndPrivacy->term!!}</textarea>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="mb-2">
                        <label for="" class="form-label">Privacy & Policy*</label>
                        <textarea name="privacy" class="textArea">{!!$TermAndPrivacy->privacy!!}</textarea>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="text-end">
                        <button type="submit" class="btn btn-purple">UPDATE</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
