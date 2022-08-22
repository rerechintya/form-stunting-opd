@extends('layout.base')

@section('title', 'Form Dinkes')

@section('main-content')

    <div class="row">
        <div class="col-12">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Form Input Dinkes</h1>
        </div>
        @if ($errors->any())
            <div class="col-12">
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            </div>
        @endif
        @if (session('error') || session('success'))
            <div class="col-12">
                <div class="alert {{ session('success') ? 'alert-success' : 'alert-danger' }} alert-dismissable fade show" role="alert">
                    {{ session('error') ?? session('success') }}
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        @endif
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="{{ url('/form/dinkes/submit') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bulan dan Tahun</label>
                            <div class="col-sm-2">
                                <input type="month" class="form-control" name="date" value="{{ old('date') }}">
                            </div>
                        </div>

                        <!-- Nav pills -->
                        <ul class="nav nav-tabs mt-5">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#kesehatan">Kesehatan (Data Supply)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#DataStunting">Data Stunting Balita</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#RemajaPutri1">Remaja Putri (Anemia)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Remaja Putri (TTD)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">PUS 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">PUS 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Bumil 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Bumil 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Bumil 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Balita 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Balita 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Balita 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Balita 4</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Balita 5</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Balita 6</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Keluarga Beresiko 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#">Keluarga Beresiko 2</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade" id="kesehatan">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Desa/Kelurahan yang melaksanakan Sanitasi Total Berbasis Masyarakat (STBM)</th>
                                                <th>Publikasi data stunting tingkat Kabupaten/Kota</th>
                                                <th>Terselenggaranya audit anak berusia dibawah dua tahun (baduta) Stunting</th>
                                                <th>Kabupaten/Kota yang mengimplementasikan sistem data surveilans gizi elektronik dalam pemantauan intervensi gizi untuk penurunan stunting</th>
                                                <th>Desa/Kelurahan yang telah tebebas dari buang air besar sembarangan (ODF)</th>
                                                <th>Persentase target sasaran yang memiliki pemahaman yang baik tentang stunting di lokasi prioritas</th>
                                                <th>Terpenuhinya standar pelayanan pemantauan tumbuh kembang di posyandu</th>
                                                <th>Tersedianya bidan desa/kelurahan sesuai kebutuhan</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="desa_kelurahan_melaksanakan_stbm[]" class="form-control" value="{{ old('desa_kelurahan_melaksanakan_stbm.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="publikasi_tingkat_kabupaten_kota[]" class="form-control" value="{{ old('publikasi_tingkat_kabupaten_kota.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="terselenggara_audit_baduta_stunting[]" class="form-control" value="{{ old('terselenggara_audit_baduta_stunting.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik[]" class="form-control" value="{{ old('kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="desa_kelurahan_terbebas_babs_odf[]" class="form-control" value="{{ old('desa_kelurahan_terbebas_babs_odf.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="persentase_sasaran_pemahaman_stunting[]" class="form-control" value="{{ old('persentase_sasaran_pemahaman_stunting.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="terpenuhi_standar_pemantauan_di_posyandu[]" class="form-control" value="{{ old('terpenuhi_standar_pemantauan_di_posyandu.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="tersedia_bidan_desa_kelurahan[]" class="form-control" value="{{ old('tersedia_bidan_desa_kelurahan.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            
                            <div class="tab-pane fade" id="DataStunting">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Nama Desa</th>
                                                <th>Jumlah Balita</th>
                                                <th>Jumlah Balita Sangat Pendek</th>
                                                <th>Jumlah Balita Pendek</th>	
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah_balita[]" class="form-control" value="{{ old('jumlah_balita.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah_balita_sangat_pendek[]" class="form-control" value="{{ old('jumlah_balita_sangat_pendek.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah_balita_pendek[]" class="form-control" value="{{ old('jumlah_balita_pendek.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="RemajaPutri1">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Remaja putri yang di periksa Hb dengan satus anemia</th>
                                                <th>Jumlah remaja putri anemia yang mendapatkan pelayanan pemeriksaan Hb</th>
                                                <th>Persentase remaja putri menerima layanan pemeriksaan status anemia terhadap remaja putri dalam kurun waktu yang sama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                $i = 0;
                                            @endphp
                                            @foreach($kelurahan as $kel)
                                                <tr>
                                                    <td class="text-center">{{ ($i++) + 1 }}</td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="remaja_putri_status_anemia[]" class="form-control" value="{{ old('remaja_putri_status_anemia.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jumlah_remaja_putri_dapat_pelayanan[]" class="form-control" value="{{ old('jumlah_remaja_putri_dapat_pelayanan.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_remaja_putri_anemia[]" class="form-control" value="{{ old('presentase_remaja_putri_anemia.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <button class="btn btn-outline-success mt-3 float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection