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
    #datatable_paginate{
        float: right;
    }
    #datatable_length{
        display: none;
    }
</style>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <div class="card card-body">
                <strong>SERVICE PRODUCT LISTS</strong>
                <table id="datatable" class="userList table dt-responsive table-responsive nowrap">
                    <thead>
                        <tr>
                            <th>Sl</th>
                            <th>Image</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Brand</th>
                            <th class="text-center">Device</th>
                            <th class="text-center">Model</th>
                            <th class="text-center">Service Type</th>
                            <th class="text-end">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $key => $content)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td><img width="50" src="{{asset('/uploads/images/service/product/'.$content->image)}}" alt=""></td>
                            <td class="text-center">{{$content->name}}</td>
                            <td class="text-center">{{$content->price}}</td>
                            <td class="text-center">{{$content->rel_to_brand->name}}</td>
                            <td class="text-center">{{$content->rel_to_device->name}}</td>
                            <td class="text-center">{{$content->rel_to_model->name}}</td>
                            <td class="text-center">{{$content->rel_to_type->name}}</td>
                            <td class="text-end">
                                <button data-bs-toggle="modal" data-bs-target="#viewProduct" onclick="viewProduct({{ $content->id }})" class="btn btn-sm btn-purple view_product"><i class="mdi mdi-eye"></i></button>
                                <a class="btn btn-sm btn-info" href="{{route('service.edit.product',$content->id)}}"><i class="mdi mdi-pencil"></i></a>
                                <button class="btn btn-sm btn-danger del" name="{{route('service.delete.product',$content->id)}}"><i class="mdi mdi-delete"></i></button>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

 <!-- Standard modal content -->
 <div id="viewProduct" class="modal fade view_product" tabindex="-1" role="dialog" aria-labelledby="viewProductLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="viewProductLabel">Product Info</h4>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row" style="align-items: center">
                    <div class="col-lg-4">
                        <img class="product_img" width="100%" src="" alt="">
                    </div>
                    <div class="col-lg-8">
                        <h4 class="product_name"></h4>
                        <p><span class="product_price"></span></p>
                        <p><span class="product_brand"></span></p>
                        <p><span class="product_device"></span> || <span class="product_model"></span></p>
                        <p><span class="product_type"></span></p>
                    </div>
                </div>
                <hr>
                <h6>Short Description</h6>
                <div class="short_description mb-2"></div>
                <h6>Long Description</h6>
                <div class="long_description"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Close</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

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
        function viewProduct(id) {
            $.ajax({
                type: 'GET',
                url: "{{ route('getProduct') }}",
                data: {
                    'id': id
                },
                dataType: "json",
                success: function(res) {
                    $('#viewProduct').modal('show');
                    var image = "{{ asset('uploads/images/service/product') }}" + "/" + res.image;

                    $(".product_name").text(res.name);
                    $(".product_img").attr("src", image);
                    $(".product_price").text("Price : " + res.price);
                    $(".product_type").text("Service Type : " + res.rel_to_type.name);
                    $(".product_model").text("Model : " + res.rel_to_model.name);
                    $(".product_brand").text("Brand : " + res.rel_to_brand.name);
                    $(".product_device").text("Device : " + res.rel_to_device.name);
                    $(".short_description").html(res.short_desp);
                    $(".long_description").html(res.long_desp);
                }
            });
        }
    </script>
@endsection
