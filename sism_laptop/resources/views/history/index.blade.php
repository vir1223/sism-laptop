@extends('layouts.app')

@section('content')
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-2 text-gray-800">History Data</h1>

    <!-- DataTales Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">History Records</h6>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>User</th>
                            <th>Murid</th>
                            <th>Guru</th>
                            <th>Alasan</th>
                            <th>Tanggal Izin</th>
                            <th>Sesi</th>
                            <th>Persetujuan</th>
                            <th>Created At</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($historyData as $history)
                        <tr>
                            <td>{{ $history->id }}</td>
                            <td>{{ $history->user ? $history->user->name : '-' }}</td>
                            <td>{{ $history->murid ? $history->murid->nama : '-' }}</td>
                            <td>{{ $history->guru ? $history->guru->nama : '-' }}</td>
                            <td>{{ $history->alasan }}</td>
                            <td>{{ $history->tanggal_izin }}</td>
                            <td>{{ $history->sesi }}</td>
                            <td>{{ $history->persetujuan }}</td>
                            <td>{{ $history->created_at }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            {{ $historyData->links() }}
        </div>
    </div>

</div>
@endsection
