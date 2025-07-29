@extends('layouts.dashboard')

@section('content')
<div class="container">
    <div class="row">
        <div class="col-lg-6 m-auto">
            <div class="text-end">
                <a href="{{ route('service.index.model') }}" class="btn btn-success mb-1"><i class="mdi mdi-arrow-left"></i> GO BACK</a>
            </div>
            <form action="{{ route('service.update.model') }}" method="POST">
            @csrf
                <div class="card card-body">
                    <div class="mb-1">
                        <div class="d-flex" style="justify-content: space-between;">
                            <strong class="text-dark">Model Edit</strong>
                        </div>
                    </div>
                    <input type="hidden" value="{{$model->id}}" name="id">
                    <div class="mb-1">
                        <label for="" class="form-label">Device*</label>
                        <select name="device" class="form-control" id="">
                            <option value="">-- Select Device --</option>
                            @foreach ($device as $content)
                            <option {{($model->device == $content->id?'selected':'')}} value="{{$content->id}}">{{$content->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="" class="form-label">Model Name*</label>
                        <input type="text" class="form-control" value="{{$model->name}}" name="name">
                    </div>
                </div>

                <div class="text-end">
                    <button type="submit" class="btn btn-primary">UPDATE MODEL</button>
                </div>
            </form>
        </div>
    </div>
</div>>
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
@endsection
