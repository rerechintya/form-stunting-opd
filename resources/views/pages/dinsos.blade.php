@extends('layout.base')

@section('title', 'Form Dinsos')

@section('main-content')
<div class="row">
        <div class="col-12">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Form Input Dinsos</h1>
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
                    <form action="{{ url('/form/dinsos/submit') }}" method="POST">
                        @csrf
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bulan dan Tahun</label>
                            <div class="col-sm-2">
                                <input type="month" class="form-control" name="date" value="{{ old('date') }}">
                            </div>
                        </div>
                      <ul class="nav nav-tabs" style="margin-top:50px">
                        <li class="nav-item">
                          <a class="nav-link active" data-toggle="pill" href="#kominfo">Kominfo</a>
                        </li>
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
                      <div class="tab-content">
                            <div class="tab-pane active" id="kominfo">
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <div class="card" style="border-top: none; border-top-left-radius: 0;">
                                        <div class="card-body d-flex flex-column individual-question">
                                            <h5><strong>Terlaksanannya kampanye nasional pencegahan stunting</strong></h5>
                                            <span><strong>Target:</strong> 3 kanal/metode</span>
                                            <span><strong>Tahun:</strong> Tiap bulan</span>
                                            <span><strong>Urusan:</strong> Komunikasi dan Informasi</span>
                                            <span>
                                                <strong>Status: </strong>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="ya" name="terlaksana_kampanye_pencegahan_stunting">
                                                    <label class="form-check-label">Ya</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" value="tidak" name="terlaksana_kampanye_pencegahan_stunting">
                                                    <label class="form-check-label">Tidak</label>
                                                </div>
                                            </span>
                                            <span>
                                                <strong>Keterangan:</strong>
                                                <textarea name="keterangan_terlaksana_kampanye_pencegahan_stunting" class="form-control">{{ old('keterangan_terlaksana_kampanye_pencegahan_stunting') }}</textarea>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sos">
                                <div class="table-responsive" style="max-height: 80vh; overflow: scroll">
                                    <table class="table table-striped table-hover table-form">
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
                                              @for ($i = 1; $i <= 151; $i++)
                                                  <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>Sukasari</td>
                                                    <td>Sukarasa</td>
                                                    <td><input type="number" name="bps[]" class="form-control"></td>
                                                    <td><input type="number" name="kemendagri[]" class="form-control"></td>
                                                    <td><input type="text" name="desa" class="form-control"></td>
                                                    <td><input type="number" name="pbi[]" class="form-control"></td>
                                                    <td><input type="number" name="tunai[]" class="form-control"></td>
                                                    <td><input type="number" name="sosial[]" class="form-control"></td>
                                                    <td><input type="number" name="pkh[]" class="form-control"></td>
                                                  </tr>
                                              @endfor
                                      </tbody>
                                    </table>
                                </div>
                              </div>
                              <div class="tab-pane fade" id="pus5">
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
                                          <th scope="col">PUS dengan status miskin mendapatkan bantuan tunai bersyarat</th>
                                          <th scope="col">Jumlah PUS keseluruhan</th>
                                          <th scope="col">Persentase PUS miskin dan penyandang masalah sosial yang menerima bantuan tunai bersyarat (BST, KJS) terhadap jumlah PUS miskin dan penyandang masalah sosial</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                              @for ($i = 1; $i <= 151; $i++)
                                                  <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>3273250</td>
                                                    <td>Sukasari</td>
                                                    <td><input type="number" name="puskes[]" class="form-control"></td>
                                                    <td><input type="text" name="puskesmas" class="form-control"></td>
                                                    <td><input type="number" name="bps[]" class="form-control"></td>
                                                    <td><input type="number" name="kemendagri[]" class="form-control"></td>
                                                    <td><input type="text" name="nama_desa" class="form-control"></td>
                                                    <td><input type="number" name="pustunai[]" class="form-control"></td>
                                                    <td><input type="number" name="jumpus[]" class="form-control"></td>
                                                    <td><input type="number" name="persentase[]" class="form-control"></td>
                                                  </tr>
                                              @endfor
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
                                          <th scope="col">ID Puskesmas</th>
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
                                              @for ($i = 1; $i <= 151; $i++)
                                                  <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>3273250</td>
                                                    <td>Sukasari</td>
                                                    <td><input type="number" name="puskes[]" class="form-control"></td>
                                                    <td><input type="text" name="puskesmas" class="form-control"></td>
                                                    <td><input type="number" name="bps[]" class="form-control"></td>
                                                    <td><input type="number" name="kemendagri[]" class="form-control"></td>
                                                    <td><input type="text" name="nama_desa" class="form-control"></td>
                                                    <td><input type="number" name="pusnontunai[]" class="form-control"></td>
                                                    <td><input type="number" name="jumpus[]" class="form-control"></td>
                                                    <td><input type="number" name="persentasebpnt[]" class="form-control"></td>
                                                  </tr>
                                              @endfor
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
                                          <th scope="col">ID Puskesmas</th>
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
                                              @for ($i = 1; $i <= 151; $i++)
                                                  <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>3273250</td>
                                                    <td>Sukasari</td>
                                                    <td><input type="number" name="puskes[]" class="form-control"></td>
                                                    <td><input type="text" name="puskesmas" class="form-control"></td>
                                                    <td><input type="number" name="bps[]" class="form-control"></td>
                                                    <td><input type="number" name="kemendagri[]" class="form-control"></td>
                                                    <td><input type="text" name="nama_desa" class="form-control"></td>
                                                    <td><input type="number" name="pusiuran[]" class="form-control"></td>
                                                    <td><input type="number" name="jumpus[]" class="form-control"></td>
                                                    <td><input type="number" name="persentasepbi[]" class="form-control"></td>
                                                  </tr>
                                              @endfor
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
                                          <th scope="col">ID Puskesmas</th>
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
                                              @for ($i = 1; $i <= 151; $i++)
                                                  <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>3273250</td>
                                                    <td>Sukasari</td>
                                                    <td><input type="number" name="puskes[]" class="form-control"></td>
                                                    <td><input type="text" name="puskesmas" class="form-control"></td>
                                                    <td><input type="number" name="bps[]" class="form-control"></td>
                                                    <td><input type="number" name="kemendagri[]" class="form-control"></td>
                                                    <td><input type="text" name="nama_desa" class="form-control"></td>
                                                    <td><input type="number" name="jumkpm_pkh[]" class="form-control"></td>
                                                    <td><input type="number" name="jumkpm_pkh_all[]" class="form-control"></td>
                                                    <td><input type="number" name="persentasep2k2[]" class="form-control"></td>
                                                  </tr>
                                              @endfor
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
                                              @for ($i = 1; $i <= 151; $i++)
                                                  <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>3273250</td>
                                                    <td>Sukasari</td>
                                                    <td><input type="number" name="puskes[]" class="form-control"></td>
                                                    <td><input type="text" name="puskesmas" class="form-control"></td>
                                                    <td><input type="number" name="bps[]" class="form-control"></td>
                                                    <td><input type="number" name="kemendagri[]" class="form-control"></td>
                                                    <td><input type="text" name="nama_desa" class="form-control"></td>
                                                    <td><input type="number" name="jumkph_pangan[]" class="form-control"></td>
                                                    <td><input type="number" name="jumkph_penerima[]" class="form-control"></td>
                                                    <td><input type="number" name="persentasekpm_hpk[]" class="form-control"></td>
                                                  </tr>
                                              @endfor
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