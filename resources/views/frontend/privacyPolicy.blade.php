@extends('layouts.app')

@section('content')
<section id="privacyPolicy">
    <div class="container">
        {!!$privacy->privacy!!}
    </div>
</section>
@endsection
