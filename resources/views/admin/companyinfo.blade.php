@extends('layouts.dashboard')

@section('content')
    <form action="{{route('CompanyProfile.update')}}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="container">
            <div class="row">
                <div class="text-start">
                    <strong><i>Company Info</i></strong>
                </div>
                <div class="col-lg-4">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="mb-1">
                                    <label for="" class="form-label">Company Logo (575 X 182)</label>
                                    <input type="file" class="form-control" name="logo" oninput="L.src=window.URL.createObjectURL(this.files[0])">
                                    <img id="L" style="width: 100%; height:180px" src="{{asset('/uploads/images/company/'.$companyInfo->logo)}}" alt="logo">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-1">
                                    <label for="" class="form-label">Favicon (70 X 70)</label>
                                    <input type="file" class="form-control" name="favicon" oninput="F.src=window.URL.createObjectURL(this.files[0])">
                                    <img id="F" style="width: 70px; height:70px;" src="{{asset('/uploads/images/company/'.$companyInfo->favicon)}}" alt="favicon">
                                </div>
                            </div>
                            <div class="col-lg-12 mt-3"><i>Fun Fact</i></div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Satisfaction Guaranteed (%)</label>
                                    <input type="text" class="form-control" name="satisfaction" value="{{$companyInfo->satisfaction}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Glory Years in Market (YEAR)</label>
                                    <input type="text" class="form-control" name="experience" value="{{$companyInfo->experience}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Happy Customers (No.)</label>
                                    <input type="text" class="form-control" name="customers" value="{{$companyInfo->customers}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Successfully Repaired (No.)</label>
                                    <input type="text" class="form-control" name="repaired" value="{{$companyInfo->repaired}}" required>
                                </div>
                            </div>

                            <div class="mb-2 mt-2 text-end">
                                <button type="submit" class="btn btn-purple">UPDATE</button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="card card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Company Name*</label>
                                    <input type="text" class="form-control" name="name" value="{{$companyInfo->name}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Company Email*</label>
                                    <input type="text" class="form-control" name="email" value="{{$companyInfo->email}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Company Hotline*</label>
                                    <input type="text" class="form-control" name="hotline" value="{{$companyInfo->hotline}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-2">
                                    <label for="" class="form-label">Company Whatsapp*</label>
                                    <input type="text" class="form-control" name="whatsapp" value="{{$companyInfo->whatsapp}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="" class="form-label">Company Address*</label>
                                    <input type="text" class="form-control" name="address" value="{{$companyInfo->address}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="" class="form-label">Map Url*</label>
                                    <input type="text" class="form-control" name="map" value="{{$companyInfo->map}}" required>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="" class="form-label">Company Shop & Floor*</label>
                                    <input type="text" class="form-control" name="shop_floor" value="{{$companyInfo->shop_floor}}" required>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="" class="form-label">Facebook</label>
                                    <div class="input-group">
                                        <a target="_blank" href="{{$companyInfo->facebook == null?'#':$companyInfo->facebook}}" class="btn btn-secondary"><i class="fab fa-facebook-f"></i></a>
                                        <input name="facebook" type="text" class="form-control" value="{{$companyInfo->facebook}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="" class="form-label">Instagram</label>
                                    <div class="input-group">
                                        <a target="_blank" href="{{$companyInfo->instagram == null?'#':$companyInfo->instagram}}" class="btn btn-secondary"><i class="fab fa-instagram"></i></a>
                                        <input type="text" class="form-control" name="instagram" value="{{$companyInfo->instagram}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="" class="form-label">Youtube</label>
                                    <div class="input-group">
                                        <a target="_blank" href="{{$companyInfo->youtube == null?'#':$companyInfo->youtube}}" class="btn btn-secondary"><i class="fab fa-youtube"></i></a>
                                        <input type="text" class="form-control" name="youtube" value="{{$companyInfo->youtube}}">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="mb-1">
                                    <label for="" class="form-label">TikTok</label>
                                    <div class="input-group">
                                        <a target="_blank" href="{{$companyInfo->tiktok == null?'#':$companyInfo->tiktok}}" class="btn btn-secondary"><i class="mdi mdi-music-note"></i></a>
                                        <input type="text" class="form-control" value="{{$companyInfo->tiktok}}" name="tiktok">
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="mb-2">
                                    <label for="" class="form-label">Description*</label>
                                    <textarea name="description" class="textArea">{!!$companyInfo->description!!}</textarea>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
