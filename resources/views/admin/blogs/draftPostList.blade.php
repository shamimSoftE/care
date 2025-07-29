@extends('layouts.dashboard')

@section('content')
<style>
    .long_desp img{
        max-width: 100%;
        height: auto;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <strong>Drafts Posts List</strong>
                <table id="datatable" class="userList table dt-responsive table-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Title</th>
                            <th>View</th>
                            <th>Edit</th>
                            <th>Schedule Post</th>
                            <th>Publish Post</th>
                        </tr>
                    </thead>


                    <tbody>
                        @foreach ($draftsPost as $key => $content)
                        <tr>
                            <td><img width="60" class="me-1" src="{{asset('/uploads/images/blogs/'.$content->image)}}" alt=""> {{ Str::of($content->title)->limit(40) }} </td>
                            <td>
                                <a style="cursor: pointer" data-bs-toggle="modal" data-bs-target="#bs-example-modal-lg{{$content->id}}" class="text-purple ms-1 me-1"><i class="fa fa-eye"></i></a>
                            </td>
                            <td>
                                <a href="{{route('blogEdit',$content->id)}}" class="text-info ms-1 me-1"><i class="fa fa-pen"></i></a>
                            </td>
                            <td><form action="{{ route('updatePostStatus') }}" method="POST">@csrf
                                <input type="hidden" name="id" value="{{$content->id}}">
                                <input name="publishDate" min="{{date("Y-m-d",strtotime(' +1 day'))}}" type="date" class="form-control mb-1" value="{{date("Y-m-d",strtotime(' +1 day'))}}">
                                <button type="submit" class="btn btn-info">SCHEDULE NOW</button></form>
                            </td>
                            <td>
                                <a href="{{ route('updateBlogToPost',$content->id) }}" class="btn btn-success">PUBLISH NOW</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>


<!--  Modal content for the Large example -->
@foreach ($draftsPost as $key => $content)
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
                        <div class="mb-1">
                            <strong><i class="mdi mdi-tag"></i> Tags : </strong> {{$content->tags != null ?    implode(', ', $arrData) : ''}}
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
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
@endforeach

@endsection

@section('script')
    <!-- third party js -->
    <script src= {{ asset('dashboard/assets/libs/datatables.net/js/jquery.dataTables.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-buttons/js/buttons.html5.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-buttons/js/buttons.flash.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-buttons/js/buttons.print.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/datatables.net-select/js/dataTables.select.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/pdfmake/build/pdfmake.min.js') }}></script>
    <script src= {{ asset('dashboard/assets/libs/pdfmake/build/vfs_fonts.js') }}></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    <script src= {{ asset('dashboard/assets/js/pages/datatables.init.js') }}></script>
    <script>
        function printDiv(divName) {
          var printContents = document.getElementById(divName).innerHTML;
          var originalContents = document.body.innerHTML;
          document.body.innerHTML = printContents;
          window.print();
          document.body.innerHTML = originalContents;
        }
    </script>

    <script>
         // Get today's date
        var today = new Date().toISOString().split('T')[0];

        // Set the minimum date for the date picker to today
        document.getElementById("minToday").setAttribute("min", today);
    </script>
@endsection
