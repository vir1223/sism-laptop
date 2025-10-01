@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Murid</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Status Perizinan Anda</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Pengguna</th>
                                        <th>Penanggung Jawab</th>
                                        <th>Alasan</th>
                                        <th>Sesi</th>
                                        <th>Status Perizinan</th>
                                        <th>Tanggal Izin</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($perizinans as $perizinan)
                                        <tr>
                                            <td>{{ $perizinan->user->username }}</td>
                                            <td>{{ $perizinan->guru->name_guru }}</td>
                                            <td>{{ $perizinan->alasan }}</td>
                                            <td>{{ $perizinan->sesi }}</td>
                                            <td>
                                                @if($perizinan->persetujuan == 'menunggu')
                                                    <span class="badge badge-warning">menunggu</span>
                                                @elseif($perizinan->persetujuan == 'disetujui')
                                                    <span class="badge badge-success">Disetujui</span>
                                                @elseif($perizinan->persetujuan == 'ditolak')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $perizinan->tanggal_izin }}</td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="6" class="text-center">Tidak ada data perizinan.</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
