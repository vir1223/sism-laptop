@extends('layouts.app')
@section('content')
    <div class="container-fluid">
        <!-- Page Heading -->
        <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <h1 class="h3 mb-0 text-gray-800">Dashboard Guru</h1>
        </div>

        <!-- Content Row -->
        <div class="row">
            <div class="col-lg-12">
                <div class="card shadow mb-4">
                    <div class="card-header py-3">
                        <h6 class="m-0 font-weight-bold text-primary">Permintaan Perizinan Kepada Anda</h6>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                <thead>
                                    <tr>
                                        <th>Nama Murid</th>
                                        <th>Nama Pengguna</th>
                                        <th>Alasan</th>
                                        <th>Sesi</th>
                                        <th>Status Perizinan</th>
                                        <th>Tanggal Izin</th>
                                        <th>Aksi</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($perizinans as $perizinan)
                                        <tr>
                                            <td>{{ $perizinan->murid->name_murid }}</td>
                                            <td>{{ $perizinan->user->username }}</td>
                                            <td>{{ $perizinan->alasan }}</td>
                                            <td>{{ $perizinan->sesi }}</td>
                                            <td>
                                                @if($perizinan->persetujuan == 'pending')
                                                    <span class="badge badge-warning">Pending</span>
                                                @elseif($perizinan->persetujuan == 'approved')
                                                    <span class="badge badge-success">Disetujui</span>
                                                @elseif($perizinan->persetujuan == 'rejected')
                                                    <span class="badge badge-danger">Ditolak</span>
                                                @endif
                                            </td>
                                            <td>{{ $perizinan->tanggal_izin->format('d-m-Y') }}</td>
                                            <td>
                                                @if($perizinan->persetujuan == 'pending')
                                                    <form action="{{ route('perizinan.update-status', $perizinan->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="status" value="approved">
                                                        <button type="submit" class="btn btn-success btn-sm">Setujui</button>
                                                    </form>
                                                    <form action="{{ route('perizinan.update-status', $perizinan->id) }}" method="POST" style="display: inline;">
                                                        @csrf
                                                        @method('POST')
                                                        <input type="hidden" name="status" value="rejected">
                                                        <button type="submit" class="btn btn-danger btn-sm">Tolak</button>
                                                    </form>
                                                @else
                                                    -
                                                @endif
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td colspan="7" class="text-center">Tidak ada permintaan perizinan.</td>
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
