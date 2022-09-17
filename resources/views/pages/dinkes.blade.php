@extends('layout.base')

@section('title', 'Form Dinkes')

@section('main-content')
    <div class="row">
        <div class="col-12 d-flex flex-row align-items-center justify-content-between mb-4">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Form Input Dinkes</h1>
            <button class="btn btn-outline-primary ml-4" data-toggle="modal" data-target="#form-history">Riwayat Input</button>
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
                                <a class="nav-link" data-toggle="pill" href="#RemajaPutri2">Remaja Putri (TTD)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Pus1">PUS 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Pus2">PUS 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Bumil1">Bumil 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Bumil2">Bumil 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Balita1">Balita 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Balita2">Balita 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Balita3">Balita 3</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Balita4">Balita 4</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Balita5">Balita 5</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#Balita6">Balita 6</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#KelResiko1">Keluarga Beresiko 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#KelResiko2">Keluarga Beresiko 2</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="kesehatan">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vh; overflow: scroll">
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
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
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
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
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

                            <div class="tab-pane fade" id="RemajaPutri2">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Remaja Putri Konsumsi TTD</th>
                                                <th>Jumlah remaja putri keseluruhan</th>
                                                <th>Persentase Remaja putri yang mengonsumsi Tablet Tambah Darah (TTD)</th>
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
                                                        <input type="number" name="remaja_putri_konsum_ttd[]" class="form-control" value="{{ old('remaja_putri_konsum_ttd.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_remaja_putri_seluruh[]" class="form-control" value="{{ old('jml_remaja_putri_seluruh.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentasi_remaja_putri_konsum_ttd[]" class="form-control" value="{{ old('presentasi_remaja_putri_konsum_ttd.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Pus1">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah calon pengantin yang mendapatkan tablet tambah darah</th>
                                                <th>Jumlah calon pengantin keseluruhan (Kemenag)</th>
                                                <th>Persentase penerimaan TTD bagi calon pengantin terhadap seluruh  calon pengantin dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="jml_calon_pengantin_dapat_ttd[]" class="form-control" value="{{ old('jml_calon_pengantin_dapat_ttd.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_calon_pengantin_seluruh[]" class="form-control" value="{{ old('jml_calon_pengantin_seluruh.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus1[]" class="form-control" value="{{ old('presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus1.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Pus2">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Calon Pasangan usia Subur memperoleh pemeriksaan 3 bulan pra nikah</th>
                                                <th>Jumlah pasangan usia subur yang mendaftarkan pernikahan</th>
                                                <th>Persentase penerimaan TTD bagi calon pengantin terhadap seluruh  calon pengantin dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="calon_pasangan_dapat_pemeriksaan_3bln_pranikah[]" class="form-control" value="{{ old('calon_pasangan_dapat_pemeriksaan_3bln_pranikah.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_pasangan_yg_daftar_pranikah[]" class="form-control" value="{{ old('jml_pasangan_yg_daftar_pranikah.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus2[]" class="form-control" value="{{ old('presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus2.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Bumil1">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah ibu hamil yang mendapatkan Asupan gizi  (PMT)</th>
                                                <th>Jumlah keseluruhan ibu hamil KEK</th>
                                                <th>Persentase layanan tambahan asupan gizi terhadap seluruh Bumil KEK dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="jml_ibu_hamil_dapat_asupan_gizi_pmt[]" class="form-control" value="{{ old('jml_ibu_hamil_dapat_asupan_gizi_pmt.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_keseluruhan_ibu_hamil_kek[]" class="form-control" value="{{ old('jml_keseluruhan_ibu_hamil_kek.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentasi_layanan_tambahan_asupan_gizi_bumil_kek[]" class="form-control" value="{{ old('presentasi_layanan_tambahan_asupan_gizi_bumil_kek.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Bumil2">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah ibu hamil mengkonsumsi tablet tambah minimal 90 tablet</th>
                                                <th>Jumlah ibu hamil yang mendapatkan tablet tambah darah</th>
                                                <th>Persentase ibu hamil mengonsumsi TTD minimal 90 tablet selama kehamilan terhadap seluruh ibu hamil dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="jml_ibu_hamil_konsum_tablet_min_90_tablet[]" class="form-control" value="{{ old('jml_ibu_hamil_konsum_tablet_min_90_tablet.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_ibu_hamil_dapat_ttd[]" class="form-control" value="{{ old('jml_ibu_hamil_dapat_ttd.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_ibu_hamil_konsum_ttd_90_tablet_selama_hamil[]" class="form-control" value="{{ old('presentase_ibu_hamil_konsum_ttd_90_tablet_selama_hamil.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Balita1">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah bayi usia kurang dari 6 bulan mendapatkan ASI ekslusif</th>
                                                <th>Jumlah keseluruhan bayi usia kurang dari 6 bulan</th>
                                                <th>Persentase bayi usia kurang dari 6 bulan mendapat ASI Ekslusif terhadap seluruh bayi kurang dari 6 bulan dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="jml_bayi_krg_6_bulan_dapat_asi_ekslusif[]" class="form-control" value="{{ old('jml_bayi_krg_6_bulan_dapat_asi_ekslusif.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_seluruh_bayi_krg_6_bulan[]" class="form-control" value="{{ old('jml_seluruh_bayi_krg_6_bulan.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_bayi_dapat_asi_krg_6_bulan[]" class="form-control" value="{{ old('presentase_bayi_dapat_asi_krg_6_bulan.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Balita2">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah anak usia 6-23 bulan uang mendapatkan makanan  pendamping ASI</th>
                                                <th>Jumlah anak usia 6-23 bulan keseluruhan</th>
                                                <th>Persentase anak usia 6-23 bulan mendapat MP-ASI layak terhadap seluruh anak usia 6-23 bulan dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="jml_anak_usia_6_23_bulan_dapat_makanan_pedamping_asi[]" class="form-control" value="{{ old('jml_anak_usia_6_23_bulan_dapat_makanan_pedamping_asi.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_anak_usia_6_23_bulan_seluruh[]" class="form-control" value="{{ old('jml_anak_usia_6_23_bulan_seluruh.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_anak_usia_6_23_bulan_dapat_mpasi[]" class="form-control" value="{{ old('presentase_anak_usia_6_23_bulan_dapat_mpasi.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Balita3">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah anak berusia di bawah lima tahun (balita) gizi buruk yang mendapat pelayanan tata laksana gizi buruk</th>
                                                <th>Jumlah seluruh balita gizi buruk</th>
                                                <th>Persentase layanan tata laksana gizi buruk terhadap seluruh anak balita gizi buruk  dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="jml_anak_balita_yg_dapat_layanan_gizi_buruk[]" class="form-control" value="{{ old('jml_anak_balita_yg_dapat_layanan_gizi_buruk.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_seluruh_balita_gizi_buruk[]" class="form-control" value="{{ old('jml_seluruh_balita_gizi_buruk.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_layanan_gizi_buruk_thdp_balita[]" class="form-control" value="{{ old('presentase_layanan_gizi_buruk_thdp_balita.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Balita4">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Anak berusia di bawah lima tahun (balita)  yang dipantau pertumbuhan dan perkembangannya</th>
                                                <th>Jumlah keseluruhan anak balita</th>
                                                <th>Persentase layanan pemantauan pertumbuhan dan perkembangan balita terhadap seluruh anak balita dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="balita_yg_dipantau_tumbuh_kembang[]" class="form-control" value="{{ old('balita_yg_dipantau_tumbuh_kembang.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_seluruh_balita_balita4[]" class="form-control" value="{{ old('jml_seluruh_balita_balita4.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_layanan_pantau_tumbuh_kembang_balita[]" class="form-control" value="{{ old('presentase_layanan_pantau_tumbuh_kembang_balita.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Balita5">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah anak berusia di bawah lima tahun (balita) gizi kurang yang mendapat tambahan asupan gizi</th>
                                                <th>Jumlah seluruh balita gizi kurang</th>
                                                <th>Persentase layanan tambahan asupan gizi balita terhadap seluruh anak balita dalam kurun waktu yang sama</th>
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
                                                        <input type="number" name="jml_balita_dapat_asupan_gizi[]" class="form-control" value="{{ old('jml_balita_dapat_asupan_gizi.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_seluruh_balita_gizi_kurang[]" class="form-control" value="{{ old('jml_seluruh_balita_gizi_kurang.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_layanan_asupan_gizi_thdp_balita[]" class="form-control" value="{{ old('presentase_layanan_asupan_gizi_thdp_balita.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="Balita6">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Balita yang memperoleh imunisasi dasar lengkap</th>
                                                <th>Jumlah keseluruhan anak balita</th>
                                                <th>Persentase layanan imunisasi dasar lengkap balita terhadap seluruh anak balita dalam kurun waktu yang sama</th>
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
                                                    <td>
                                                        <input type="number" name="balita_peroleh_imunisasi_lengkap[]" class="form-control" value="{{ old('balita_peroleh_imunisasi_lengkap.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_seluruh_balita_balita6[]" class="form-control" value="{{ old('jml_seluruh_balita_balita6.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_layanan_imunisasi_lengkap_balita[]" class="form-control" value="{{ old('presentase_layanan_imunisasi_lengkap_balita.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="KelResiko1">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah keluarga memiliki akses jamban sehat</th>
                                                <th>Jumlah keluarga keseluruhan</th>
                                                <th>Persentase keluarga yang telah stop BABS terhadap seluruh KK</th>
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
                                                        <input type="number" name="jml_kel_miliki_jamban_sehat[]" class="form-control" value="{{ old('jml_kel_miliki_jamban_sehat.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_kel_keseluruhan_kel_resiko1[]" class="form-control" value="{{ old('jml_kel_keseluruhan_kel_resiko1.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_kel_yg_telah_stop_babs[]" class="form-control" value="{{ old('presentase_kel_yg_telah_stop_babs.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="KelResiko2">
                                <div class="alert alert-info alert-dismissable fade show mt-3" role="alert">
                                    Setiap kolom harus diisi. Bila ada data yang kosong, masukkan "0".
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="table-responsive" style="max-height: 90vhh; overflow: scroll">
                                    <table class="table table-striped table-bordered table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th>No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th>Jumlah keluarga yang melaksanakan PHBS</th>
                                                <th>Jumlah keluarga keseluruhan</th>
                                                <th>Persentase keluarga yang telah melaksanakan PHBS terhadap seluruh KK</th>
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
                                                        <input type="number" name="jml_kel_laksanakan_phbs[]" class="form-control" value="{{ old('jml_kel_laksanakan_phbs.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="jml_kel_keseluruhan_kel_resiko2[]" class="form-control" value="{{ old('jml_kel_keseluruhan_kel_resiko2.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="presentase_kel_telah_laksanakan_phbs[]" class="form-control" value="{{ old('presentase_kel_telah_laksanakan_phbs.'.$i-1) }}">
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


@section('modal-section')
    <div class="modal fade" id="form-history">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Riwayat Input</h5>
                    <button class="close">&times;</button>
                </div>
                <div class="modal-body">
                    <table class="table table-bordered table-hover">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>Bulan & Tahun</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        @php
                            $no = 1;
                        @endphp
                            @foreach ($report_history as $report)
                                <tr class="text-center">
                                    <td>{{ $no++ }}</td>
                                    <td>{{ $months[$report->bulan - 1] . " " . $report->tahun }}</td>
                                    <td>
                                        <a class="btn btn-sm btn-outline-warning" href="{{ url('form/dinkes/' . "$report->tahun-$report->bulan") }}">Lihat</a>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
@endsection