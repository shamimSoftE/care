@extends('layouts.dashboard')

@section('content')
@can('role_management')
<div class="container">
    <div class="row">
        {{-- Assign Permission to role --}}
        <div class="col-lg-8">
            <div class="card card-body">
                <div class="mb-1">
                    <strong class="text-dark">Assign Persmission To Roles</strong>
                </div>
                <form action="{{route('assignPermToRole')}}" method="POST">@csrf
                    <div class="mb-1">
                        <label for="" class="form-label">Role Name</label>
                        <select id="" name="role" class="form-control">
                            <option value="">-- Select Role --</option>
                            @foreach ($roles as $key => $content)
                            <option value="{{$content->id}}">{{$content->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-1">
                        <label for="" class="form-label">Permissions</label><br>
                        <div class="row">
                        @foreach ($permissions->chunk(10) as $item)
                            <div class="col-lg-4 col-md-4">
                                @foreach ($item as $content)
                                <input type="checkbox" name="permissions[]" value="{{$content->id}}"> {{$content->name}} <br>
                                @endforeach
                            </div>
                        @endforeach
                        </div>
                    </div>
                    <div class="mb-1">
                        <button class="btn btn-primary">Assign</button>
                    </div>
                </form>
                <div class="mb-1">
                    <strong class="text-dark">Assigned Roles To Permissions</strong>
                </div>
                <div class="mb-1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Role Name</th>
                                <th>Permissions</th>
                                <th></th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $content)
                            <tr>
                                <td>{{$content->name}}</td>
                                <td>
                                @foreach ($content->getAllPermissions() as $perm)
                                    >> {{ $perm->name }} <br>
                                @endforeach</td>
                                <td><a href="{{route('editRolePermissions',$content->id)}}" class="text-info"><i class="mdi mdi-pencil"></i></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Data</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Add Roles --}}
        <div class="col-lg-4">
            <div class="card card-body">
                <div class="mb-1">
                    <strong class="text-dark">ADD Roles</strong>
                </div>
                <form action="{{route('storeRoleName')}}" method="POST">@csrf
                    <div class="mb-1">
                        <label for="" class="form-label">Role Name</label>
                        <div class="input-group">
                            <input type="text" value="" placeholder="ex:admin" name="rolename" class="form-control">
                            <button class="btn btn-primary">ADD</button>
                        </div>
                    </div>
                </form>
                <div class="mb-1">
                    <strong class="text-dark">List of Roles</strong>
                </div>
                <div class="mb-1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Code/Name</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($roles as $key => $content)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$content->name}}</td>
                                <td><a href="{{route('editRolePermissions',$content->id)}}" class="text-info"><i class="mdi mdi-pencil"></i></a></td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="3">No Data</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        {{-- Add permission --}}
        {{-- <div class="col-lg-3">
            <div class="card card-body">
                <div class="mb-1">
                    <strong class="text-dark">ADD Permission</strong>
                </div>
                <form action="{{route('storePermission')}}" method="POST">@csrf
                    <div class="mb-1">
                        <label for="" class="form-label">Permission Code/Name</label>
                        <div class="input-group">
                            <input type="text" value="" placeholder="ex:user_control" name="permission" class="form-control">
                            <button class="btn btn-primary">ADD</button>
                        </div>
                    </div>
                </form>
                <div class="mb-1">
                    <strong class="text-dark">List of Permission</strong>
                </div>
                <div class="mb-1">
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Sl.</th>
                                <th>Code/Name</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($permissions as $key => $content)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$content->name}}</td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">No Data</td>
                            </tr>
                            @endforelse

                        </tbody>
                    </table>
                </div>
            </div>
        </div> --}}
    </div>
</div>
@else
    <div class="alert alert-danger">
        <strong>Sorry you don't have permission for this page</strong>
    </div>
@endcan
@endsection
