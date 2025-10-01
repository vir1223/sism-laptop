@extends('layouts.app')
@section('head')
<link href="{{ asset('/') }}sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

@endsection
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
  <h1 class="h3 mb-2 text-gray-800">Data Guru</h1>
  
  <!-- DataTales Example -->
  <div class="card shadow mb-4">
    <div class="card-header py-3">
      <span class="m-0 font-weight-bold text-primary">Guru</span>
      <span> | </span>
      <a href="{{ route('bidang.index') }}" class="m-0 font-weight-bold text-secondary">Bidang</a>        
      <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Nip</th>
                        <th>Bidang</th>
                        <th>Username</th>
                        <th >Action</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>Name</th>
                        <th>Nip</th>
                        <th>Bidang</th>
                        <th>Username</th>
                        <th >Action</th>
                    </tr>
                </tfoot>
                <tbody>
                    @foreach ($dataGuru as $guru)
                    <tr>
                        <td>{{ $guru->name_guru?? 'unassained' }}</td>
                        <td>{{ $guru->nip?? 'unassained' }}</td>
                        <td>{{ $guru->bidang->name_bidang?? 'unassained' }}</td>
                        <td>{{ $guru->user->username?? 'unassained' }}</td>
                        <td><a class="btn btn-primary" href="{{ route('guru.edit', $guru->id) }}">Edit</a></td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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