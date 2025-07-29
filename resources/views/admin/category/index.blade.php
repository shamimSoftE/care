@extends('layouts.dashboard')

@section('content')
<style>
    #datatable_paginate{
        float: right;
    }
    #datatable_length{
        display: none;
    }
</style>
<div class="container">
    <div class="row">
        <div class="col-lg-5">
            <form action="{{route('categoryStore')}}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="card card-body">
                    <div class="mb-1">
                        <strong class="text-dark">Category Entry</strong>
                    </div>
                    <div class="mb-1">
                        <label for="" class="form-label">Category Name*</label>
                        <input type="text" class="form-control" value="{{old('name')}}" name="name">
                    </div>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-primary">INSERT CATEGORY</button>
                </div>
            </form>
        </div>
        <div class="col-lg-7">
            <div class="card card-body">
                <table id="datatable" class="userList table dt-responsive table-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Category Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($category as $key => $content)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$content->name}}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('categoryEdit',$content->id)}}"><i class="mdi mdi-pencil"></i></a>


                                <button class="btn btn-danger del" name="{{route('categorySoftDelete',$content->id)}}"><i class="mdi mdi-delete"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
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
