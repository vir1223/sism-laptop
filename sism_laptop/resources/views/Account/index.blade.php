@extends('layouts.app')
@section('head')
<link href="{{ asset('/') }}sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

@endsection
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Akun</h1>
    @if(session('success'))
    <div style="color: green;">
        {{ session('success') }}
        <br>
        <strong>New Password: <code>{{ session('new_password') }}</code></strong>
    </div>
    @endif


    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Data Akun</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="4">
                                <a href="{{ route('account.create') }}" class="btn btn-primary w-100 ">
                                    Add Account
                                </a>
                            </th>
                        </tr>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Reset Password</th>
                            <th>Delete</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Username</th>
                            <th>Role</th>
                            <th>Password</th>
                            <th>Delete</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($akun as $akunku)
                        <tr>
                            <td>{{ $akunku['username'] }}</td>
                            <td>{{ $akunku['role'] }}</td>
                            <td>
                                <form action="{{ route('account.reset',[$akunku->id]) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-secondary">Reset Password</button>
                                </form>
                            </td>
                            <td>
                                <form action="{{ route('account.destroy',[$akunku->id]) }}" method="POST">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">DELETE</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>
<!-- /.container-fluid -->

@endsection
@section('script')

<!-- Page level plugins -->
<script src="{{ asset('/') }}sbadmin2/vendor/datatables/jquery.dataTables.min.js"></script>
<script src="{{ asset('/') }}sbadmin2/vendor/datatables/dataTables.bootstrap4.min.js"></script>

<!-- Page level custom scripts -->
<script src="{{ asset('/') }}sbadmin2/js/demo/datatables-demo.js"></script>

@endsection