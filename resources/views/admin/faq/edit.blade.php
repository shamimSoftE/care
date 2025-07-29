@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="text-end">
        <a href="{{route('faq.index')}}" class="btn btn-success mb-1"><i class="mdi mdi-arrow-left"></i> GO BACK</a>
    </div>
    <div class="row mb-1">
        <div class="col-lg-12">
            <div class="card card-body">
                <strong class="mb-2">FAQs Content</strong>
                <form action="{{route('faq.update')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="id" value="{{$faq->id}}">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Type</label>
                                <select name="type" class="form-control" id="">
                                    <option value="">-- Select Type --</option>
                                    <option {{old('type',$faq->type) == 'g'?'selected':''}} value="g">General Questions</option>
                                    <option {{old('type',$faq->type) == 'r'?'selected':''}} value="r">Repairs & Technical</option>
                                    <option {{old('type',$faq->type) == 'n'?'selected':''}} value="n">Nationwide Service</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 row">
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="" class="form-label">Question ?</label>
                                    <textarea name="que" class="form-control" rows="4">{{old('que',$faq->que)}}</textarea>
                                </div>
                                <button class="btn btn-dark">INSERT CONTENT</button>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="" class="form-label">Answer</label>
                                    <textarea name="ans" class="form-control" rows="4">{{old('ans',$faq->ans)}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
