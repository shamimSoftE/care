@extends('layouts.dashboard')

@section('content')
<div class="container">
    {{-- <button onclick="printDiv('print')" class="btn btn-primary btn-sm float-right">
        <i class="fa fa-print mr-1"></i> Print
    </button> --}}
    <div class="card" id="print">
        <div class="card-body">
            <h4 class="mt-0 mb-3 header-title">User List</h4>

            <table class="table table-bordered table-responsive">
                <thead>
                    <tr>
                        <th>Sl</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Phone Number</th>
                        <th>Register at</th>
                        {{-- @can('user_assign_role')
                        <th>Assign Role</th>
                        @endcan --}}
                        <th>Action</th>
                    </tr>
                </thead>


                <tbody>
                    @foreach ($user as $key => $useList)
                    <tr>
                        <td>{{ $key+1 }} </td>
                        <td>{{ $useList->name }}</td>
                        <td>{{ $useList->email }}</td>
                        <td>{{ ($useList->phone != Null?$useList->phone:'N/A') }}</td>
                        <td>{{ $useList->created_at->format("d-M-Y") }}</td>
                        {{-- @can('user_assign_role')
                        <td>
                            <select data-id="{{ $useList->id }}" class="form-control role" name="role_id">
                                @php
                                    $user = App\Models\User::find($useList->id);
                                @endphp
                                @foreach ($role as $content)
                                <option {{($user->hasRole($content->name)?'selected':'')}} value="{{$content->id}}">{{$content->name}}</option>
                                @endforeach
                            </select>
                        </td>
                        @endcan --}}
                        <td>
                            <a href="{{ route('userAccount', $useList->id) }}" class="btn btn-info"><i class="mdi mdi-pencil"></i></a>
                            <a href="{{ route('userDelete', $useList->id) }}" class="btn btn-danger"><i class="mdi mdi-delete"></i></a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('script')
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
        $(document).ready(function() {
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            });
            //Assign Role
            $(".role").on("change", function(e) {
                let id = $(this).data('id');
                let role = $(this).val();

                $.ajaxSetup({
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });
                $.ajax({
                    url: "/assign/role/to/user",
                    type: "POST",
                    data: {
                        id: id,
                        role: role,
                    },
                    success: function(data) {
                        var response = JSON.parse(data);
                        if (response.status == 'success')
                        {
                            Toast.fire({
                                icon: 'success',
                                title: response.message,
                            });
                        }
                        else
                        {
                            Toast.fire({
                                icon: 'error',
                                title: response.message,
                            });
                        }
                    }
                });

            });
        });
    </script>
@endsection
