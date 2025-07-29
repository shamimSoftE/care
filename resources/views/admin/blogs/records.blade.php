@extends('layouts.dashboard')

@section('content')
<style>
    .custom_css{
        margin-top: 30px;
        padding: 4px 10px;
    }
    .long_desp img{
        max-width: 100% !important;
        height: auto;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <div class="d-flex" style="justify-content: space-between">
                    <strong class="text-dark">Search Filter :</strong>
                    <strong class="text-dark">Found : {{$blogs->count()}}</strong>
                </div>
                <div class="row">
                    <div class="col-lg-3">
                        <label for="" class="form-label">By Text</label>
                        <input type="text" class="form-control" id="search_input" value="{{(isset($_GET['q'])?$_GET['q']:'')}}">
                    </div>
                    <div class="col-lg-2">
                        <label for="" class="form-label">By Date (Start)</label>
                        <input type="date" class="form-control" id="startDate" value="{{(isset($_GET['sd'])?$_GET['sd']:'')}}">
                    </div>
                    <div class="col-lg-2">
                        <label for="" class="form-label">By Date (End)</label>
                        <input type="date" id="endDate" class="form-control" value="{{(isset($_GET['ed'])?$_GET['ed']:'')}}">
                    </div>
                    <div class="col-lg-2">
                        <label for="" class="form-label">By Category</label>
                        <select id="search_category" class="form-control" name="" id="">
                            <option value="">-- Select Category --</option>
                            @foreach ($category as $content)
                            <option @if (isset($_GET['c'])) {{($_GET['c'] == $content->id?'selected':'')}} @endif
                            value="{{$content->id}}">{{$content->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-lg-1">
                        <button id="search_btn" class="btn btn-primary custom_css">Search</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th>Title</th>
                            <th>Date</th>
                            <th>Category</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($blogs as $key => $content)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img width="60" src="{{asset('/uploads/images/blogs/'.$content->image)}}" alt="{{$content->imageAlt}}"></td>
                            <td>{{Str::of($content->title)->limit(20)}}</td>
                            <td>{{$content->date}}</td>
                            <td>{{$content->rel_to_category->name}}</td>
                            <td>
                                <a style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg{{$content->id}}" class="text-purple ms-1 me-1"><i class="fa fa-eye"></i></a>

                                <a href="{{route('blogEdit',$content->id)}}" class="text-info ms-1 me-1"><i class="fa fa-pen"></i></a>


                                <a style="cursor: pointer;" name="{{route('blogSoftDelete',$content->id)}}" class="text-danger del ms-1 me-1"><i class="mdi mdi-delete"></i></a>

                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7">No Data Found</td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!--  Modal content for the Large example -->
@foreach ($blogs as $key => $content)
<div class="modal fade" id="bs-example-modal-lg{{$content->id}}" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="myLargeModalLabel">
                   <strong class="text-primary">Title : </strong><span class="text-dark">{{$content->title}}</span><br>
                   <strong class="text-primary">Category : </strong><span class="text-dark">{{$content->rel_to_category->name}}</span>
                </h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-6">
                        <div class="type mb-2">
                            @if ($content->type == 1)
                            <span class="external-event bg-success">Published</span>
                            @endif
                            @if ($content->type == 2)
                            <span class="external-event bg-warning">Scheduled</span>
                            @endif
                            @if ($content->type == 3)
                            <span class="external-event bg-secondary">Draft</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="type mb-2 text-end">
                            @if ($content->type == 2)
                            <span class="text-warning">Publish Date : {{$content->publishDate}}</span>
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="date text-start mb-1 text-danger">
                            <i class="mdi mdi-clock-outline"></i> {{$content->date}}
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="by text-end mb-1 text-info">
                            <i class="fa fa-user"></i> By {{$content->rel_to_user->name}}
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-1">
                            <strong class="text-primary">Short Description : </strong>
                            <p>{{$content->short_desp}}</p>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="mb-1">
                            <strong class="text-primary">Long Description : </strong>
                            <div class="long_desp">
                                {!!$content->long_desp!!}
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="image">
                            <strong class="text-primary">Main Image : </strong>
                            <img style="max-width: 100%; width:100%;" src="{{asset('/uploads/images/blogs/'.$content->image)}}" alt="{{$content->imageAlt}}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endforeach

@endsection

@section('script')
<script>
    $('#search_btn').click(function(c){
        let search_input = $('#search_input').val();
        let search_category = $('#search_category').val();
        let startDate = $('#startDate').val();
        let endDate = $('#endDate').val();
        let url = "{{ route('blogRecords') }}?"+"q="+search_input+"&c="+search_category+"&sd="+startDate+"&ed="+endDate;
        window.location.href = url;
    })
</script>
@endsection
