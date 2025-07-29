@extends('layouts.dashboard')

@section('content')
<style>
    .ck-editor__editable {min-height: 170px;}
</style>
<div class="container">
    <div class="row mb-1">
        <div class="col-lg-12">
            <div class="card card-body">
                <i class="mb-2">FAQs Content</i>
                <form action="{{route('faq.store')}}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-1">
                                <label for="" class="form-label">Type</label>
                                <select name="type" class="form-control" id="">
                                    <option value="">-- Select Type --</option>
                                    <option {{old('type') == 'g'?'selected':''}} value="g">General Questions</option>
                                    <option {{old('type') == 'r'?'selected':''}} value="r">Repairs & Technical</option>
                                    <option {{old('type') == 'n'?'selected':''}} value="n">Nationwide Service</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-12 row">
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="" class="form-label">Question ?</label>
                                    <textarea name="que" class="form-control" rows="4">{{old('que')}}</textarea>
                                </div>
                                <button class="btn btn-dark">INSERT CONTENT</button>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="" class="form-label">Answer</label>
                                    <textarea name="ans" class="form-control" rows="4">{{old('ans')}}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>sl.</th>
                            <th>Type</th>
                            <th>Question</th>
                            <th>Answer</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($faq as $key => $content)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    @if ($content->type == 'g')
                                    General Questions
                                    @elseif ($content->type == 'r')
                                    Repairs & Technical
                                    @else
                                    Nationwide Service
                                    @endif
                                </td>
                                <td>{{$content->que }}?</td>
                                <td>{{$content->ans }}</td>
                                <td>
                                    <a class="text-info" href="{{route('faq.edit',$content->id)}}"><i class="mdi mdi-pencil"></i></a>
                                    <a style="cursor: pointer;" class="text-danger del" name="{{route('faq.delete',$content->id)}}"><i class="mdi mdi-delete"></i></a>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5">No Data Found</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
