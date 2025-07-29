@extends('layouts.dashboard')
@section('links')
    <!-- Select2 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
@endsection

@section('content')
        <style>
            .ck-editor__editable {
                min-height: 200px;
            }
        </style>
        <div class="container">
            <div class="row">
                <div class="col-lg-6">
                    <div class="py-1">
                        <h2>Service Product</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="py-1 text-end">
                        <a href="{{ route('service.list.product') }}" class="btn btn-primary">VIEW RECORDS</a>
                    </div>
                </div>
            </div>
            <form action="{{ route('service.store.product') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">
                    <div class="col-lg-8">
                        <div class="card card-body mb-1">
                            <div class="mb-1 row">
                                <div class="col-lg-8">
                                    <label for="" class="form-label">Name<span class="text-danger">*</span></label>
                                    <input required type="text" class="form-control" value="{{ old('name') }}"
                                    name="name">
                                </div>
                                <div class="col-lg-4">
                                    <label for="" class="form-label">Price<span class="text-danger">*</span></label>
                                    <input required type="text" class="form-control" value="{{ old('price') }}"
                                    name="price">
                                </div>
                            </div>
                            <div class="mb-1 row">
                                <div class="col-lg-6">
                                    <div class="mb-1 ">
                                        <label for="" class="form-label">Brand<span class="text-danger">*</span></label>
                                        <div class="input-group ">
                                            <select class="form-control" name="brand">
                                                <option value="">-- Select Brand --</option>
                                                @foreach ($brand as $b)
                                                <option {{ old('brand') == $b->id ? 'selected' : '' }}
                                                    value="{{ $b->id }}">{{ $b->name }}</option>
                                                @endforeach
                                            </select>
                                            <a class="btn btn-info" href="{{ route('service.index.model') }}"><i
                                                    class="mdi mdi-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="" class="form-label">Device<span class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <select id="device" required class="form-control" name="device">
                                            <option value="">-- Select Device --</option>
                                            @foreach ($device as $d)
                                                <option {{ old('device') == $d->id ? 'selected' : '' }}
                                                    value="{{ $d->id }}">{{ $d->name }}</option>
                                            @endforeach
                                        </select>
                                        <a class="btn btn-info" href="{{ route('service.index.type') }}"><i class="mdi mdi-plus"></i></a>
                                    </div>
                                </div>

                            </div>
                            <div class="mb-1 row">
                                <div class="col-lg-6">
                                    <div class="mb-1 ">
                                        <label for="" class="form-label">Model<span class="text-danger">*</span></label>
                                        <div class="input-group ">
                                            <select id="getModel" class="form-control" name="model">
                                                <option value="">-- Select Model --</option>
                                            </select>
                                            <a class="btn btn-info" href="{{ route('service.index.model') }}"><i
                                                    class="mdi mdi-plus"></i></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <label for="" class="form-label">Service Type<span class="text-danger">*</span></label>
                                    <div class="input-group ">
                                        <select id="type" required class="form-control" name="type">
                                            <option value="">-- Select Type --</option>
                                            @foreach ($type as $t)
                                                <option {{ old('type') == $t->id ? 'selected' : '' }}
                                                    value="{{ $t->id }}">{{ $t->name }}</option>
                                            @endforeach
                                        </select>
                                        <a class="btn btn-info" href="{{ route('service.index.type') }}"><i class="mdi mdi-plus"></i></a>
                                    </div>
                                </div>

                            </div>

                            <div class="mb-1 ">
                                <label for="" class="form-label">Slug<span class="text-danger">*</span> (unique)</label>
                                <div class="input-group ">
                                    <input style="width:35%; background:#eee;" readonly type="text" class="form-control"
                                        value="https://example.com/product/">
                                    <input required style="width:65%;" type="text" class="form-control"
                                        value="{{ old('slug') }}" name="slug">
                                </div>
                            </div>
                            <div class="mb-1 ">
                                <label for="" class="form-label">Long Description <span class="text-danger">*</span></label>
                                <textarea class="textArea " name="long_desp">{{ old('long_desp') }}</textarea>
                            </div>
                            <div class="mb-1 ">
                                <label for="" class="form-label">Short Description <span class="text-danger">*</span></label>
                                <textarea class="textArea " name="short_desp">{{ old('short_desp') }}</textarea>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4">
                        <div class="card card-body">
                            <div class="mb-2">
                                <label for="" class="form-label">Image<span class="text-danger">*</span> <span class="text-danger">(600 X 600)</span></label>
                                <div class="input-group">
                                    <input type="text" class="form-control" placeholder="Image Alt Text"
                                        value="" name="imageAlt">
                                    <label for="altImage" class="btn btn-info">CHOOSE IMAGE</label>
                                </div>

                                <input style="display: none;" id="altImage" type="file" class="form-control"
                                    value="" name="image"
                                    oninput="I.src=window.URL.createObjectURL(this.files[0])">
                            </div>
                            <div class="mb-2">
                                <img width="150" id="I"
                                    src="{{ asset('/uploads/images/service/product/default.jpg') }}" alt="">
                            </div>
                        </div>
                        <div class="text-end">
                            <button style="width:100%;" type="submit" class="btn text-white btn-success">INSERT PRODUCT</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
@endsection

@section('script')
    <script>
        $('#device').change(function() {
            var device_id = $(this).val();
            var url = '{{ route('getModel') }}'

            $.ajax({
                type: 'GET',
                url: url,
                data: {
                    'type_id': device_id
                },
                success: function(data) {
                    var str = '<option value="">-- Select Model --</option>';
                    $.each(data, function(index, value) {
                        str += `<option value="${value.id}">${value.name}</option>`
                    });
                    $('#getModel').html(str);
                }
            });
        });
        $('input[name="name"]').on('keyup', function() {
            let input = $(this).val();
            slug(input);
        });
        $('input[name="slug"]').on('keyup', function() {
            let input = $(this).val();
            slug(input);
        });

        function slug(productName) {
            let string = productName.toLowerCase().trim().replace(/ /g, '-');

            if (productName != '') {
                $('input[name="slug"]').val(string);
            } else {
                $('input[name="slug"]').val('');
            }
        }

    </script>
@endsection
