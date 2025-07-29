@extends('layouts.app')

@section('content')
<section id="termCondition">
    <div class="container">
        {!!$term->term!!}
    </div>
</section>
@endsection
