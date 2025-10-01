@extends('layouts.app')
@section('head')
<link href="{{ asset('/') }}sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">

@endsection
@section('content')


<!-- Begin Page Content -->
<div class="container-fluid">
    <h1 class="h3 mb-2 text-gray-800">Data Perizinan</h1>
    
    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">     
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>Peminta</th>
                            <th>Murid Pengguna</th>
                            <th>Penangung Jawab</th>
                            <th>Alasan</th>
                            <th >Tanggal Izin</th>
                            <th>Sesi</th>
                            <th>Persetujuan</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>Peminta</th>
                            <th>Murid Pengguna</th>
                            <th>Penangung Jawab</th>
                            <th>Alasan</th>
                            <th >Tanggal Izin</th>
                            <th>Sesi</th>
                            <th>Persetujuan</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @foreach ($dataPerizinan as $perizinan)
                        <tr>
                            <td>{{ $perizinan->user->username?? 'unassained' }}</td>
                            <td>{{ $perizinan->murid->name_murid?? 'unassained' }}</td>
                            <td>{{ $perizinan->guru->name_guru?? 'unassained' }}</td>
                            <td>{{ $perizinan->alasan?? 'unassained' }}</td>
                            <td>{{ $perizinan->tanggal_izin?? 'unassained' }}</td>
                            <td>{{ $perizinan->sesi?? 'unassained' }}</td>
                            <td>{{ $perizinan->persetujuan?? 'unassained' }}</td>
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