@extends('layout.base')

@section('title', 'Edit Form Diskominfo')

@section('main-content')

    <div class="row">
        <div class="col-12 d-flex flex-row align-items-center justify-content-between mb-4">
            <!-- Page Heading -->
            <h1 class="h3 text-gray-800">Form Edit Dinsos</h1>
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
                    <form action="{{ url('/form/dinsos/update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="id_report_non_kelurahan" value="{{ $report_non_kelurahan['id'] }}" readonly>
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bulan dan Tahun</label>
                            <div class="col-sm-2">
                                <input type="month" class="form-control" name="date" value="{{ $report_non_kelurahan['tahun'] .'-'. substr('0' . $report_non_kelurahan['bulan'], -2) }}">
                            </div>
                        </div>

                        <!-- Nav pills -->
                        <ul class="nav nav-tabs mt-5">
                        <li class="nav-item">
                            <a class="nav-link active" data-toggle="pill" href="#sos">Sosial(data suply)</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#pus5">PUS 5</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#pus6">PUS 6</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#pus7">PUS 7</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#perlindungan-sosial1">Perlindungan Sosial 1</a>
                          </li>
                          <li class="nav-item">
                            <a class="nav-link" data-toggle="pill" href="#perlindungan-sosial2">Perlindungan Sosial 2</a>
                          </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane fade" id="sos">
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
                                            <th scope="col">No</th>
                                            <th scope="col">Kecamatan</th>
                                            <th scope="col">Puskesmas</th>
                                            <th scope="col">Kode Desa/Kelurahan BPS</th>
                                            <th scope="col">Kode Desa/Kelurahan Kemendagri</th>
                                            <th scope="col">DESA/KELURAHAN</th>
                                            <th scope="col">Cakupan Bantuan Jaminan Nasional Penerima Iuran (PBI) Kesehatan</th>
                                            <th scope="col">Jumlah Keluarga Miskin dan rentan yang memperoleh bantuan tunai bersyarat</th>
                                            <th scope="col">Jumlah keluarga miskin dan rentan yang menerima bantuan sosial pangan</th>
                                            <th scope="col">Jumlah pendampingan Program Keluarga Harapan (PKH) yang terlatih modul kesehatan dan gizi</th>
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
                                                      <td>{{ $kel->kode_bps }}</td>
                                                      <td>{{ $kel->kode_kemendagri }}</td>
                                                      <td>
                                                          {{ $kel->kelurahan }}
                                                          <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                          <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                      </td>
                                                      <td><input type="number" name="Bantuan_PBI_kesehatan[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Bantuan_PBI_kesehatan'] }}"></td>
                                                      <td><input type="number" name="Jumlah_keluarga_miskin_rentan_bantuan_tunai[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_keluarga_miskin_rentan_bantuan_tunai'] }}"></td>
                                                      <td><input type="number" name="Jumlah_keluarga_miskin_rentan_bantuan_sosial[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_keluarga_miskin_rentan_bantuan_sosial'] }}"></td>
                                                      <td><input type="number" name="Jumlah_PKH_kesehatan_gizi[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_PKH_kesehatan_gizi'] }}"></td>
                                                </tr>
                                             @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pus5">
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
                                                <th scope="col">No</th>
                                                <th scope="col">ID Kecamatan</th>
                                                <th scope="col">Kecamatan</th>
                                                <!-- <th scope="col">ID Puskesmas</th> -->
                                                <th scope="col">Nama Puskesmas</th>
                                                <th scope="col">ID Desa BPS</th>
                                                <th scope="col">ID Desa Kemendagri</th>
                                                <th scope="col">Nama Desa</th>
                                                <th scope="col">PUS dengan status miskin mendapatkan bantuan tunai bersyarat</th>
                                                <th scope="col">Jumlah PUS keseluruhan</th>
                                                <th scope="col">Persentase PUS miskin dan penyandang masalah sosial yang menerima bantuan tunai bersyarat (BST, KJS) terhadap jumlah PUS miskin dan penyandang masalah sosial</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @php
                                                  $i = 0;
                                              @endphp
                                              @foreach($kelurahan as $kel)
                                                    <tr>
                                                      <td class="text-center">{{ ($i++) + 1 }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kode_bps }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                      <!-- <td><input type="number" name="id_puskesmas"></td> -->
                                                      <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                      <td>{{ $kel->kode_bps }}</td>
                                                      <td>{{ $kel->kode_kemendagri }}</td>
                                                      <td>
                                                          {{ $kel->kelurahan }}
                                                          <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                          <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                      </td>
                                                      <td><input type="number" name="Pus_status_miskin_tunai[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Pus_status_miskin_tunai'] }}"></td>
                                                      <td><input type="number" name="Jumlah_pus5[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_pus5'] }}"></td>
                                                      <td><input type="number" name="Presentasepus_tunai_BST_KJS[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Presentasepus_tunai_BST_KJS'] }}"></td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="pus6">
                                  <div class="table-responsive" style="max-height: 80vh; overflow: scroll">
                                      <table class="table table-striped table-hover table-form">
                                        <thead>
                                          <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID Kecamatan</th>
                                            <th scope="col">Kecamatan</th>
                                            <!-- <th scope="col">ID Puskesmas</th> -->
                                            <th scope="col">Nama Puskesmas</th>
                                            <th scope="col">ID Desa BPS</th>
                                            <th scope="col">ID Desa Kemendagri</th>
                                            <th scope="col">Nama Desa</th>
                                            <th scope="col">PUS dengan status miskin mendapatkan bantuan non tunai bersyarat</th>
                                            <th scope="col">Jumlah PUS keseluruhan</th>
                                            <th scope="col">Persentase PUS miskin dan penyandang masalah sosial yang menerima BPNT terhadap jumlah PUS miskin dan penyandang masalah sosial</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                                  $i = 0;
                                              @endphp
                                              @foreach($kelurahan as $kel)
                                                    <tr>
                                                      <td class="text-center">{{ ($i++) + 1 }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kode_bps }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                      <!-- <td><input type="number" name="id_puskesmas"></td> -->
                                                      <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                      <td>{{ $kel->kode_bps }}</td>
                                                      <td>{{ $kel->kode_kemendagri }}</td>
                                                      <td>
                                                          {{ $kel->kelurahan }}
                                                          <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                          <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                      </td>
                                                      <td><input type="number" name="Pus_status_miskin_nontunai[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Pus_status_miskin_nontunai'] }}"></td>
                                                      <td><input type="number" name="Jumlah_pus6[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_pus6'] }}"></td>
                                                      <td><input type="number" name="Presentasepus_tunai_BPNT[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Presentasepus_tunai_BPNT'] }}"></td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                      </table>
                                  </div>
                            </div>
                            <div class="tab-pane fade" id="pus7">
                                  <div class="table-responsive" style="max-height: 80vh; overflow: scroll">
                                      <table class="table table-striped table-hover table-form">
                                        <thead>
                                          <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID Kecamatan</th>
                                            <th scope="col">Kecamatan</th>
                                            <!-- <th scope="col">ID Puskesmas</th> -->
                                            <th scope="col">Nama Puskesmas</th>
                                            <th scope="col">ID Desa BPS</th>
                                            <th scope="col">ID Desa Kemendagri</th>
                                            <th scope="col">Nama Desa</th>
                                            <th scope="col">PUS dengan status miskin menjadi penerima bantuan iuran jaminan kesehatan </th>
                                            <th scope="col">Jumlah PUS keseluruhan</th>
                                            <th scope="col">Persentase jumlah rumah tangga miskin peserta PBI terhadap jumlah rumah tangga miskin</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                                  $i = 0;
                                              @endphp
                                              @foreach($kelurahan as $kel)
                                                    <tr>
                                                      <td class="text-center">{{ ($i++) + 1 }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kode_bps }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                      <!-- <td><input type="number" name="id_puskesmas"></td> -->
                                                      <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                      <td>{{ $kel->kode_bps }}</td>
                                                      <td>{{ $kel->kode_kemendagri }}</td>
                                                      <td>
                                                          {{ $kel->kelurahan }}
                                                          <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                          <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                      </td>
                                                      <td><input type="number" name="Pus_status_miskin_iurankesehatan[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Pus_status_miskin_iurankesehatan'] }}"></td>
                                                      <td><input type="number" name="Jumlah_pus7[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_pus7'] }}"></td>
                                                      <td><input type="number" name="PresentaseRT_miskin_PBI[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['PresentaseRT_miskin_PBI'] }}"></td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                      </table>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="perlindungan-sosial1">
                                  <div class="table-responsive" style="max-height: 80vh; overflow: scroll">
                                      <table class="table table-striped table-hover table-form">
                                        <thead>
                                          <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID Kecamatan</th>
                                            <th scope="col">Kecamatan</th>
                                            <!-- <th scope="col">ID Puskesmas</th> -->
                                            <th scope="col">Nama Puskesmas</th>
                                            <th scope="col">ID Desa BPS</th>
                                            <th scope="col">ID Desa Kemendagri</th>
                                            <th scope="col">Nama Desa</th>
                                            <th scope="col">Jumlah KPM PKH yang mengikuti pertemuan peningkatan kemampuan keluarga dengan modul kesehatan dan gizi</th>
                                            <th scope="col">Jumlah KPM PKH keseluruhan</th>
                                            <th scope="col">Persentase  realisasi P2K2 dengan modul kesehatan dan gizi bagi KPM PKH terhadap seluruh sasaran KPM PKH</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                                  $i = 0;
                                              @endphp
                                              @foreach($kelurahan as $kel)
                                                    <tr>
                                                      <td class="text-center">{{ ($i++) + 1 }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kode_bps }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                      <!-- <td><input type="number" name="id_puskesmas"></td> -->
                                                      <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                      <td>{{ $kel->kode_bps }}</td>
                                                      <td>{{ $kel->kode_kemendagri }}</td>
                                                      <td>
                                                          {{ $kel->kelurahan }}
                                                          <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                          <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                      </td>
                                                      <td><input type="number" name="Jumlah_KPM_PKH[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_KPM_PKH'] }}"></td>
                                                      <td><input type="number" name="Jumlah_KPM_PKH_all[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_KPM_PKH_all'] }}"></td>
                                                      <td><input type="number" name="Presentase_P2K2[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Presentase_P2K2'] }}"></td>
                                                    </tr>
                                                @endforeach
                                        </tbody>
                                      </table>
                                  </div>
                                </div>
                                <div class="tab-pane fade" id="perlindungan-sosial2">
                                  <div class="table-responsive" style="max-height: 80vh; overflow: scroll">
                                      <table class="table table-striped table-hover table-form">
                                        <thead>
                                          <tr>
                                            <th scope="col">No</th>
                                            <th scope="col">ID Kecamatan</th>
                                            <th scope="col">Kecamatan</th>
                                            <th scope="col">ID Puskesmas</th>
                                            <th scope="col">Nama Puskesmas</th>
                                            <th scope="col">ID Desa BPS</th>
                                            <th scope="col">ID Desa Kemendagri</th>
                                            <th scope="col">Nama Desa</th>
                                            <th scope="col">Jumlah KPM dengan ibu hamil, ibu menyusui dan baduta yang menerima variasi bantuan pangan selain beras dan telur</th>
                                            <th scope="col">Jumlah KPM dengan ibu hamil, ibu menyusui dan baduta penerima bantuan</th>
                                            <th scope="col">Persentase KPM 1.000 HPK yang menerima variasi BPNT terhadap total KPM 1.000 HPK</th>
                                          </tr>
                                        </thead>
                                        <tbody>
                                          @php
                                                  $i = 0;
                                              @endphp
                                              @foreach($kelurahan as $kel)
                                                    <tr>
                                                      <td class="text-center">{{ ($i++) + 1 }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kode_bps }}</td>
                                                      <td>{{ $kel->parent_kecamatan->kecamatan }}</td>
                                                      <td><input type="number" name="id_puskesmas"></td>
                                                      <td>{{ $kel->parent_puskesmas->puskesmas}}</td>
                                                      <td>{{ $kel->kode_bps }}</td>
                                                      <td>{{ $kel->kode_kemendagri }}</td>
                                                      <td>
                                                          {{ $kel->kelurahan }}
                                                          <input type="hidden" name="kelurahan[]" value="{{ $kel->id }}" readonly>
                                                          <input type="hidden" name="id_report_kelurahan[]" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['id'] }}" readonly>
                                                      </td>
                                                      <td><input type="number" name="Jumlah_bantuan_pangan[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_bantuan_pangan'] }}"></td>
                                                      <td><input type="number" name="Jumlah_penerima_bantuan[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Jumlah_penerima_bantuan'] }}"></td>
                                                      <td><input type="number" name="Presentase_KPM[]" class="form-control" value="{{ $report_kelurahan[array_search($kel->id, $column_kelurahan_only)]['Presentase_KPM'] }}"></td>
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