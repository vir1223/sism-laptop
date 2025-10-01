<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>SB Admin 2 - Buat Perizinan</title>

    <link href="{{ asset('sbadmin2/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <link href="{{ asset('sbadmin2/css/sb-admin-2.min.css') }}" rel="stylesheet">

</head>

<body class="bg-gradient-primary">

    <div class="container">

        <div class="card o-hidden border-0 shadow-lg my-5">
            <div class="card-body p-0">
                <div class="row">
                    <div class="col-lg-5 d-none d-lg-block bg-register-image"></div>
                    <div class="col-lg-7">
                        <div class="p-5">
                            <div class="text-center">
                                <h1 class="h4 text-gray-900 mb-4">Buat Perizinan Baru</h1>
                            </div>
                            <form class="user" action="{{ route('perizinan.store') }}" method="POST">
                                @csrf
                                
                                <div class="form-group">
                                    <label>Nama Murid</label>
                                    <select class="form-control" name="murid_id" required>
                                        <option value="">Pilih Murid</option>
                                        @foreach($murids as $murid)
                                            <option value="{{ $murid->id }}">{{ $murid->name_murid }}</option>
                                        @endforeach
                                    </select>
                                    @error('murid_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Nama Penanggung Jawab</label>
                                    <select class="form-control" name="guru_id" required>
                                        <option value="">Pilih Guru</option>
                                        @foreach($gurus as $guru)
                                            <option value="{{ $guru->id }}">{{ $guru->name_guru }}</option>
                                        @endforeach
                                    </select>
                                    @error('guru_id')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group">
                                    <label>Alasan</label>
                                    <textarea class="form-control form-control-user" name="alasan" placeholder="Alasan"></textarea>
                                    @error('alasan')
                                        <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>

                                <div class="form-group row">
                                    <div class="form-group row">
                                        <div class="col-sm-12">
                                            <label>Sesi</label>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="siang" id="sesi_siang">
                                                <label class="form-check-label" for="sesi_siang">
                                                    Siang
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="sore" id="sesi_sore">
                                                <label class="form-check-label" for="sesi_sore">
                                                    Sore
                                                </label>
                                            </div>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox" name="sesi[]" value="malam" id="sesi_malam">
                                                <label class="form-check-label" for="sesi_malam">
                                                    Malam
                                                </label>
                                            </div>
                                            @error('sesi')
                                                <div class="text-danger">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="persetujuan" value="menunggu">

                                <input type="hidden" name="user_id" value="{{ $currentUser->id }}">


                                <button type="submit" class="btn btn-primary btn-user btn-block">
                                    Ajukan Perizinan
                                </button>
                            </form>
                            <hr>
                            <div class="text-center">
                                <a class="small" href="{{ route('perizinan.index') }}">Kembali ke halaman data</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <script src="{{ asset('sbadmin2/vendor/jquery/jquery.min.js') }}"></script>
    <script src="{{ asset('sbadmin2/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>

    <script src="{{ asset('sbadmin2/vendor/jquery-easing/jquery.easing.min.js') }}"></script>

    <script src="{{ asset('sbadmin2/js/sb-admin-2.min.js') }}"></script>

</body>

</html>