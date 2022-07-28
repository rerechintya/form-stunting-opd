@extends('layout.base')

@section('title', 'Halaman Utama')

@section('main-content')

    <div class="row">
        <div class="col-12">
            <!-- Page Heading -->
            <h1 class="h3 mb-4 text-gray-800">Form Input BPOM (Badan Pengawas Obat dan Makanan)</h1>        
        </div>
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <form action="" method="POST">
                        <div class="form-group row">
                            <label class="col-sm-2 col-form-label">Bulan dan Tahun</label>
                            <div class="col-sm-2">
                                <input type="month" class="form-control" name="bulan">
                            </div>
                        </div>

                        <!-- Nav pills -->
                        <ul class="nav nav-tabs mt-5">
                            <li class="nav-item">
                                <a class="nav-link active" data-toggle="pill" href="#sheet-1">Sheet 1</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#sheet-2">Sheet 2</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-toggle="pill" href="#sheet-3">Sheet 3</a>
                            </li>
                        </ul>

                        <!-- Tab panes -->
                        <div class="tab-content">
                            <div class="tab-pane active" id="sheet-1">
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th class="text-center">Isian 1</th>
                                                <th class="text-center">Isian 2</th>
                                                <th class="text-center">Isian 3</th>
                                                <th class="text-center">Isian 4</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 1; $i <= 151; $i++)
                                                <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>Kecamatan {{ $i }}</td>
                                                    <td>Puskesmas {{ $i }}</td>
                                                    <td>Kelurahan {{ $i }}</td>
                                                    <td>
                                                        <input type="number" name="isian-1[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-2[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-3[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-4[]" class="form-control">
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sheet-2">
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th class="text-center">Isian 5</th>
                                                <th class="text-center">Isian 6</th>
                                                <th class="text-center">Isian 7</th>
                                                <th class="text-center">Isian 8</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 1; $i <= 151; $i++)
                                                <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>Kecamatan {{ $i }}</td>
                                                    <td>Puskesmas {{ $i }}</td>
                                                    <td>Kelurahan {{ $i }}</td>
                                                    <td>
                                                        <input type="number" name="isian-5[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-6[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-7[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-8[]" class="form-control">
                                                    </td>
                                                </tr>
                                            @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="sheet-3">
                                <div class="table-responsive" style="max-height: 60vh; overflow: scroll">
                                    <table class="table table-striped table-hover table-form">
                                        <thead>
                                            <tr>
                                                <th class="text-center">No.</th>
                                                <th>Kecamatan</th>
                                                <th>Puskesmas</th>
                                                <th>Kelurahan</th>
                                                <th class="text-center">Isian 9</th>
                                                <th class="text-center">Isian 10</th>
                                                <th class="text-center">Isian 11</th>
                                                <th class="text-center">Isian 12</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @for ($i = 1; $i <= 151; $i++)
                                                <tr>
                                                    <td class="text-center">{{ $i }}</td>
                                                    <td>Kecamatan {{ $i }}</td>
                                                    <td>Puskesmas {{ $i }}</td>
                                                    <td>Kelurahan {{ $i }}</td>
                                                    <td>
                                                        <input type="number" name="isian-9[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-10[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-11[]" class="form-control">
                                                    </td>
                                                    <td>
                                                        <input type="number" name="isian-12[]" class="form-control">
                                                    </td>
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