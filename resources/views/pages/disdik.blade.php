@extends('layout.base')

@section('title', 'Form Dinas Pendidikan')

@section('main-content')

    <div class="row">
        <div class="col-12  d-flex flex-row align-items-center justify-content-between mb-4">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Form Input Dinas Pendidikan</h1>
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
                    <form action="{{ url('/form/disdik/submit') }}" method="POST">
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
                                <a class="nav-link " data-toggle="pill" href="#LPaud">Lembaga Paud</a>
                            </li>
                            <li class="nav-item"> 
                                <a class="nav-link active" data-toggle="pill" href="#parenting"> Parenting </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#pdPaud">Peserta Didik PAUD </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#pendi_1">Pendi 1 (Data Supply)</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#pendi_2">Pendi 2 (Data Supply)</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade" id="LPaud">
                                <div class="row">
                                    <div class="col-12">
                                        <h1 class="h3 mb-4 text-gray-800">Proses.. (?)</h1>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane active" id="parenting">
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
                                                <th>ID_Kecamatan</th>
                                                <th>Kecamatan</th>
                                                <th>Kode Desa/Kel Kemendagri</th>
                                                <th>Nama Desa</th>
                                                <th>Jumlah ibu hamil dan orang tua dengan anak usia Baduta yang mengikuti kelas Parenting </th>
                                                <th>Jumlah ibu hamil dan anak baduta tahun 2020 </th>
                                                <th>Cakupan orang tua yang mengikuti kelas Parenting</th>
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
                                                        {{ $kel->parent_kecamatan->kode_bps }}
                                                    </td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>
                                                        {{ $kel->kode_bps }}
                                                    </td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting[]" class="form-control" value="{{ old('juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="juml_ibu_hamil_dan_anak_baduta_tahun2020[]" class="form-control" value="{{ old('juml_ibu_hamil_dan_anak_baduta_tahun2020.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="cakupan_ortu_ikut_kls_parenting[]" class="form-control" value="{{ old('cakupan_ortu_ikut_kls_parenting.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pdPaud">
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
                                                <th>ID_Kecamatan</th>
                                                <th>Kecamatan</th>
                                                <th>Kode Desa/Kel Kemendagri</th>
                                                <th>Nama Desa</th>
                                                <th>Jumlah anak usia 2-6 tahun terdaftar (Peserta Didik) di PAUD</th>
                                                <th>Jumlah suluruh anak usia 2-6 tahun</th>
                                                <th>Cakupan anak usia 2-6 tahun terdaftar (Peserta Didik) di PAUD</th>
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
                                                        {{ $kel->parent_kecamatan->kode_bps }}
                                                    </td>
                                                    <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                    <td>
                                                        {{ $kel->kode_bps }}
                                                    </td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="juml_anak_usia_2_sd_6_terdaftar[]" class="form-control" value="{{ old('juml_anak_usia_2_sd_6_terdaftar.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="juml_seluruh_anak_usia_2_sd_6[]" class="form-control" value="{{ old('juml_seluruh_anak_usia_2_sd_6.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="cakupan_anak_usia_2_sd_6_terdaftar[]" class="form-control" value="{{ old('cakupan_anak_usia_2_sd_6_terdaftar.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pendi_1">
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
                                                <th>Kode Desa/Kel BPS</th>
                                                <th>Kode Desa/Kel Kemendagri</th>
                                                <th>Nama Desa</th>
                                                <th>Desa/kelurahan yang memiliki guru PAUD terlatih pengasuhan stimulasi penanganan stunting</th>
                                                <th>Lembaga PAUD yang mengembangkan Pendidikan Anak Usia Dini Holistik Integratif (PAUD HI)</th>
                                                <th>Jumlah Kab/Kot yang memiliki min 20 tenaga pelatih berjenjang tingkat dasar serta pendidikan dan pelatihan pengasuhan stimulasi penanganan stunting bagi guru PAUD</th>
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
                                                        {{ $kel->kode_bps }}
                                                    </td>
                                                    <td>
                                                        {{ $kel->kode_kemendagri }}
                                                    </td>
                                                    <td>
                                                        {{ $kel->kelurahan }}
                                                        <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                    </td>
                                                    <td>
                                                        <input type="number" name="desa_yg_memiliki_guru_paud_terlatih_penanganan_stunting[]" class="form-control" value="{{ old('desa_yg_memiliki_guru_paud_terlatih_penanganan_stunting.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="lemb_paud_yg_mengembangkan_paudhi[]" class="form-control" value="{{ old('lemb_paud_yg_mengembangkan_paudhi.'.$i-1) }}">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="juml_kab_kot_yg_mem_tenaga_pel_penga_stimul_penang_stunting[]" class="form-control" value="{{ old('juml_kab_kot_yg_mem_tenaga_pel_penga_stimul_penang_stunting.'.$i-1) }}">
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                            <div class="tab-pane fade" id="pendi_2">
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <div class="card" style="border-top: none; border-top-left-radius: 0;">
                                        <div class="card-body d-flex flex-column individual-question">
                                            <h5><strong>Jumlah Kabupaten/kota yang mimiliki minimal 20 tenaga pelatih berjenjang tingkat dasar serta pendidikan dan pelatihan pengasuhan stimulasi penanganan stunting bagi guru Pendidikan Anak Usia Dini (PAUD)</strong></h5>
                                            <span><strong>Target:</strong> 100% </span>
                                            <span><strong>Tahun:</strong> 2024 </span>
                                            <span><strong>Urusan:</strong> Pendidikan </span>
                                            <span>
                                                <strong>Status: </strong>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="ya" name="juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan">
                                                    <label class="form-check-label">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="tidak" name="juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan">
                                                    <label class="form-check-label">Tidak</label>
                                                </div>
                                            </span>
                                            <span>
                                                <strong>Keterangan:</strong>
                                                <textarea name="ket_juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan" class="form-control">{{ old('ket_juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan') }}</textarea>
                                            </span>
                                        </div>
                                    </div>
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
                                        <a class="btn btn-sm btn-outline-warning" href="{{ url('form/disdik/' . "$report->tahun-$report->bulan") }}">Lihat</a>
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