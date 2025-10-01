@extends('layouts.app')
@section('head')
<link href="{{ asset('/') }}sbadmin2/css/sb-admin-2.min.css" rel="stylesheet">  
<meta name="csrf-token" content="{{ csrf_token() }}">
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
                            <td>
                                <div class="dropdown">
                                    <button class="btn @if($perizinan->persetujuan == 'disetujui') 
                                                            btn-success 
                                                        @elseif($perizinan->persetujuan == 'ditolak') 
                                                            btn-danger 
                                                        @else 
                                                            btn-secondary 
                                                        @endif  
                                                        dropdown-toggle" type="button" id="dropdownMenuButton_{{ $perizinan->id }}" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                        {{ ucfirst($perizinan->persetujuan) }}
                                    </button>
                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton_{{ $perizinan->id }}">
                                        <a class="dropdown-item update-status-btn" href="#" data-id="{{ $perizinan->id }}" data-status="disetujui">Disetujui</a>
                                        <a class="dropdown-item update-status-btn" href="#" data-id="{{ $perizinan->id }}" data-status="ditolak">Ditolak</a>
                                        <a class="dropdown-item update-status-btn" href="#" data-id="{{ $perizinan->id }}" data-status="menunggu">Menunggu</a>
                                    </div>
                                </div>
                            </td>
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

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        // Tangkap klik pada setiap item dropdown
        $('.update-status-btn').on('click', function(e) {
            e.preventDefault();

            let perizinanId = $(this).data('id');
            let newStatus = $(this).data('status');
            let csrfToken = $('meta[name="csrf-token"]').attr('content');

            $.ajax({
                url: `/perizinan/update-status/${perizinanId}`,
                type: 'POST',
                data: {
                    _token: csrfToken,
                    status: newStatus
                },
                success: function(response) {
                    if (response.success) {
                        let button = $(`#dropdownMenuButton_${perizinanId}`);
                        
                        // Hapus kelas warna lama
                        button.removeClass('btn-success btn-danger btn-secondary');

                        // Tambahkan kelas warna baru berdasarkan status
                        if (newStatus === 'disetujui') {
                            button.addClass('btn-success');
                        } else if (newStatus === 'ditolak') {
                            button.addClass('btn-danger');
                        } else {
                            button.addClass('btn-secondary');
                        }

                        // Perbarui teks di tombol
                        button.text(newStatus.charAt(0).toUpperCase() + newStatus.slice(1));
                        alert('Status berhasil diperbarui!');
                    } else {
                        alert('Gagal memperbarui status.');
                    }
                },
                error: function(xhr, status, error) {
                    alert('Terjadi kesalahan saat menghubungi server.');
                    console.error(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection