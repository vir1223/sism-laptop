@extends('layouts.app')
@section('head')
<link href="{{ asset('/') }}sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

@endsection
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Kelas</h1>
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <a href="{{ route('murid.index') }}" class="m-0 font-weight-bold text-secondary">Murid</a>
            <span> | </span>
            <span class="m-0 font-weight-bold text-primary">Kelas </span>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th colspan="3">
                                <a href="{{ route('kelas.create') }}" class="btn btn-primary w-100 ">
                                    Add Kelas
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
                        @foreach ($dataKelas as $kelas)
                        <tr>
                            <td>{{ $kelas->name_kelas }}</td>
                            <td><a class="btn btn-primary" href="{{ route('kelas.edit', $kelas->id) }}">Edit</a></td>
                            <td><form action="{{ route('kelas.destroy',$kelas->id) }}" method="post">
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