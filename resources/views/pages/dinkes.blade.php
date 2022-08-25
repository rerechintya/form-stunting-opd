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

                            <div class="tab-pane fade" id="RemajaPutri2">
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
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
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
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
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
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
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
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
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

                            <button class="btn btn-outline-success mt-3 float-right">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection