@extends('layouts.dashboard')

@section('content')
@can('role_management')
<div class="container">
    <div class="row">
        {{-- Assign Permission to role --}}
        <div class="col-lg-5 m-auto">
            <div class="card card-body">
                <div class="mb-1">
                    <strong class="text-dark">Update Persmission & Name Of {{$roles->name}}</strong>
                </div>
                <form action="{{route('UpdateAssignPermToRole')}}" method="POST">@csrf
                    <div class="mb-1">
                        <label for="" class="form-label">Role Name</label>
                        <input class="form-control" type="text" value="{{$roles->name}}" name="role_name">
                        <input class="form-control" type="hidden" readonly value="{{$roles->id}}" name="role_id">
                    </div>
                    <div class="mb-1">
                        <label for="" class="form-label">Permissions</label><br>
                        <div class="row">
                        @foreach ($permissions->chunk(10) as $item)
                            <div class="col-lg-6 col-md-6">
                                @foreach ($item as $content)
                                <input {{ ($roles->hasPermissionTo($content->name)?'checked':'') }} type="checkbox" name="permissions[]" value="{{$content->id}}"> {{$content->name}} <br>
                                @endforeach
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="mb-1">
                        <button class="btn btn-primary">Update</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@else
    <div class="alert alert-danger">
        <strong>Sorry you don't have permission for this page</strong>
    </div>
@endcan
@endsection
