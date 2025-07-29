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
            <form action="{{ route('service.store.type') }}" method="POST" enctype="multipart/form-data">
            @csrf
                <div class="card card-body">
                    <div class="mb-1">
                        <strong class="text-dark">Type Entry</strong>
                    </div>
                    <div class="mb-1">
                        <label for="" class="form-label">Type Name*</label>
                        <input type="text" class="form-control" value="{{old('name')}}" name="name">
                    </div>
                    <div class="mb-1">
                        <label for="" class="form-label">Type Image (120 X 120)</label>
                        <div class="input-group">
                            <input type="text" class="form-control" placeholder="Image Alternative Text" value="" name="imageAlt">
                            <label for="TypeImage" class="btn btn-info">CHOOSE IMAGE</label>
                        </div>
                        <input style="display: none;" id="TypeImage" type="file" class="form-control" name="image" oninput="Image.src=window.URL.createObjectURL(this.files[0])" accept="image">
                    </div>
                    <div class="mb-1">
                        <img width="150" id="Image" src="{{asset('dashboard/assets/images/default.jpg')}}" alt="No Image Entered">
                    </div>
                    <div class="text-end">
                        <button type="submit" class="btn btn-primary">INSERT Type</button>
                    </div>
                </div>


            </form>
        </div>
        <div class="col-lg-7">
            <div class="card card-body">
                <table id="datatable" class="userList table dt-responsive table-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Type Image</th>
                            <th>Type Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($type as $key => $content)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img width="50" src="{{asset('/uploads/images/service/'.$content->image)}}" alt=""></td>
                            <td>{{$content->name}}</td>
                            <td>
                                <a class="btn btn-info" href="{{route('service.edit.type',$content->id)}}"><i class="mdi mdi-pencil"></i></a>
                                <button class="btn btn-danger del" name="{{route('service.delete.type',$content->id)}}"><i class="mdi mdi-delete"></i></button>
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
