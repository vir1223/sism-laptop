@extends('layouts.app')
@section('head')
<link href="{{ asset('/') }}sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

@endsection
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Bidang</h1>
     <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('guru.index') }}" class="m-0 font-weight-bold text-secondary">Guru</a>
            <span> | </span>
            <span class="m-0 font-weight-bold text-primary">Bidang </span>
        
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <a href="{{ route('bidang.create') }}" class="btn btn-primary w-100 ">
                                    Add Bidang
                                </a>
                            </th>
                        </tr>
                        <tr>
                            <th>Name</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Name</th>
                            <th colspan="2">Action</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($dataBidang as $bidang)
                        <tr>
                            <td>{{ $bidang->name_bidang }}</td>
                            <td><a class="btn btn-primary" href="{{ route('bidang.edit', $bidang->id) }}">Edit</a></td>
                            <td><form action="{{ route('bidang.destroy',$bidang->id) }}" method="post">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form></td>
                            
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