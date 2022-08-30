<?php

namespace App\Http\Controllers;

use App\Models\Diskominfo;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DiskominfoController extends Controller
{
    private $months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $kelurahan = Kelurahan::all();
        $report_history = Diskominfo::select(DB::raw('ANY_VALUE(id), tahun, bulan'))->groupBy('bulan', 'tahun')->get();
        extract(get_object_vars($this));

        return view('pages.diskominfo', compact('kelurahan', 'report_history', 'months'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validasi kolom input yang akan diproses
         */
        $validation = $request->validate([
            'date' => 'required',
            'terlaksana_kampanye_pencegahan_stunting' => 'required',
            'keterangan_terlaksana_kampanye_pencegahan_stunting' => 'nullable|string',
            'kelurahan' => 'required',
            'kelurahan.*' => 'sometimes|numeric',
            'desa_kelurahan_melaksanakan_stbm' => 'required',
            'desa_kelurahan_melaksanakan_stbm.*' => 'sometimes|numeric',
            'publikasi_tingkat_kabupaten_kota' => 'required',
            'publikasi_tingkat_kabupaten_kota.*' => 'sometimes|numeric',
            'terselenggara_audit_baduta_stunting' => 'required',
            'terselenggara_audit_baduta_stunting.*' => 'sometimes|numeric',
            'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik' => 'required',
            'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik.*' => 'sometimes|numeric',
            'desa_kelurahan_terbebas_babs_odf' => 'required',
            'desa_kelurahan_terbebas_babs_odf.*' => 'sometimes|numeric',
            'persentase_sasaran_pemahaman_stunting' => 'required',
            'persentase_sasaran_pemahaman_stunting.*' => 'sometimes|numeric',
            'terpenuhi_standar_pemantauan_di_posyandu' => 'required',
            'terpenuhi_standar_pemantauan_di_posyandu.*' => 'sometimes|numeric',
            'tersedia_bidan_desa_kelurahan' => 'required',
            'tersedia_bidan_desa_kelurahan.*' => 'sometimes|numeric',
        ]);
        /**
         * Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
         */
        if (!$validation) return back();

        /**
         * Pisahkan tahun dan bulan
         */
        $date = explode('-', $request->date);
        $tahun = $date[0];
        $bulan = $date[1];

        /**
         * Cek apakah ada data pada tahun dan bulan (periode) yang sama, jika ada maka data tidak dapat disimpan untuk menghindari data duplikat
         * Lalu kembali ke halaman sebelumnya dengan pesan error
         */
        $existing_periode = Diskominfo::where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($existing_periode) {
            return back()->with('error', "Data pada periode yang sama ({$this->months[$bulan - 1]} {$tahun}) sudah ada, tidak dapat menyimpan data duplikat.")->withInput();
        }
        
        /**
         * Siapkan data yang berbentuk kolom isian status ya/tidak, contohnya pada OPD Diskominfo yaitu data pada sheet "Kominfo"
         */
        $non_kelurahan_data = [
            'tahun' => $tahun,
            'bulan' => $bulan,
            'terlaksana_kampanye_pencegahan_stunting' => $request->terlaksana_kampanye_pencegahan_stunting,
            'keterangan_terlaksana_kampanye_pencegahan_stunting' => $request->keterangan_terlaksana_kampanye_pencegahan_stunting
        ];

        /**
         * Siapkan data yang berbentuk per kelurahan, contohnya pada OPD Diskominfo yaitu data pada sheet "Kesehatan (Data Supply)"
         */
        $per_kelurahan_data = [];
        for ($i = 0; $i < count($request->desa_kelurahan_melaksanakan_stbm); $i++) {
            array_push($per_kelurahan_data, [
                'tahun' => $tahun,
                'bulan' => $bulan,
                'kelurahan' => $request->kelurahan[$i],
                'terlaksana_kampanye_pencegahan_stunting' => null,
                'keterangan_terlaksana_kampanye_pencegahan_stunting' => null,
                'desa_kelurahan_melaksanakan_stbm' => $request->desa_kelurahan_melaksanakan_stbm[$i],
                'publikasi_tingkat_kabupaten_kota' => $request->publikasi_tingkat_kabupaten_kota[$i],
                'terselenggara_audit_baduta_stunting' => $request->terselenggara_audit_baduta_stunting[$i],
                'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik' => $request->kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik[$i],
                'desa_kelurahan_terbebas_babs_odf' => $request->desa_kelurahan_terbebas_babs_odf[$i],
                'persentase_sasaran_pemahaman_stunting' => $request->persentase_sasaran_pemahaman_stunting[$i],
                'terpenuhi_standar_pemantauan_di_posyandu' => $request->terpenuhi_standar_pemantauan_di_posyandu[$i],
                'tersedia_bidan_desa_kelurahan' => $request->tersedia_bidan_desa_kelurahan[$i],
            ]);
        }

        /**
         * Submit data yang sudah disiapkan
         * Untuk data per kelurahan menggunakan perintah upsert untuk batch insert
         */
        $non_kelurahan_insert = Diskominfo::create($non_kelurahan_data);
        $per_kelurahan_insert = Diskominfo::upsert($per_kelurahan_data, []);

        /**
         * Kembali ke halaman sebelumnya dengan pesan berhasil atau gagal
         */
        if ($non_kelurahan_data && $per_kelurahan_data) return redirect('/form/diskominfo')->with('success', 'Data berhasil disimpan.');

        return back()->with('error', 'Gagal menyimpan data')->withInput();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diskominfo  $diskominfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Diskominfo $diskominfo, $params)
    {
        $periods = explode("-", $params);
        $reports = Diskominfo::where('bulan', $periods[1])->where('tahun', $periods[0])->get()->toArray();
        $kelurahan = Kelurahan::all();
        $index_report_non_kelurahan = array_keys(array_column($reports, 'kelurahan'), null)[0];
        $index_report_kelurahan = array_keys(array_column($reports, 'kelurahan'), !null);
        $index_report_kelurahan = [
            'start' => $index_report_kelurahan[0],
            'end' => $index_report_kelurahan[count($index_report_kelurahan) - 1]
        ];
        $report_non_kelurahan = array_slice($reports, $index_report_non_kelurahan, 1)[0];
        $report_kelurahan = array_slice($reports, $index_report_kelurahan['start'], $index_report_kelurahan['end']);
        $column_kelurahan_only = array_column($report_kelurahan, 'kelurahan');
        
        return view('pages.diskominfo-edit', compact('kelurahan', 'report_non_kelurahan', 'report_kelurahan', 'column_kelurahan_only'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Diskominfo  $diskominfo
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Diskominfo $diskominfo)
    {
        /**
         * Validasi kolom input yang akan diproses
         */
        $validation = $request->validate([
            'date' => 'required',
            'terlaksana_kampanye_pencegahan_stunting' => 'required',
            'keterangan_terlaksana_kampanye_pencegahan_stunting' => 'nullable|string',
            'kelurahan' => 'required',
            'kelurahan.*' => 'sometimes|numeric',
            'desa_kelurahan_melaksanakan_stbm' => 'required',
            'desa_kelurahan_melaksanakan_stbm.*' => 'sometimes|numeric',
            'publikasi_tingkat_kabupaten_kota' => 'required',
            'publikasi_tingkat_kabupaten_kota.*' => 'sometimes|numeric',
            'terselenggara_audit_baduta_stunting' => 'required',
            'terselenggara_audit_baduta_stunting.*' => 'sometimes|numeric',
            'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik' => 'required',
            'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik.*' => 'sometimes|numeric',
            'desa_kelurahan_terbebas_babs_odf' => 'required',
            'desa_kelurahan_terbebas_babs_odf.*' => 'sometimes|numeric',
            'persentase_sasaran_pemahaman_stunting' => 'required',
            'persentase_sasaran_pemahaman_stunting.*' => 'sometimes|numeric',
            'terpenuhi_standar_pemantauan_di_posyandu' => 'required',
            'terpenuhi_standar_pemantauan_di_posyandu.*' => 'sometimes|numeric',
            'tersedia_bidan_desa_kelurahan' => 'required',
            'tersedia_bidan_desa_kelurahan.*' => 'sometimes|numeric',
        ]);
        /**
         * Jika validasi gagal, kembali ke halaman sebelumnya dengan pesan error
         */
        if (!$validation) return back();

        /**
         * Pisahkan tahun dan bulan
         */
        $date = explode('-', $request->date);
        $tahun = $date[0];
        $bulan = $date[1];
        
        /**
         * Siapkan data yang berbentuk kolom isian status ya/tidak, contohnya pada OPD Diskominfo yaitu data pada sheet "Kominfo"
         */
        $non_kelurahan_data = [
            'tahun' => $tahun,
            'bulan' => $bulan,
            'terlaksana_kampanye_pencegahan_stunting' => $request->terlaksana_kampanye_pencegahan_stunting,
            'keterangan_terlaksana_kampanye_pencegahan_stunting' => $request->keterangan_terlaksana_kampanye_pencegahan_stunting
        ];

        /**
         * Siapkan data yang berbentuk per kelurahan, contohnya pada OPD Diskominfo yaitu data pada sheet "Kesehatan (Data Supply)"
         */
        $per_kelurahan_data = [];
        for ($i = 0; $i < count($request->desa_kelurahan_melaksanakan_stbm); $i++) {
            array_push($per_kelurahan_data, [
                'id' => $request->id_report_kelurahan[$i],
                'tahun' => $tahun,
                'bulan' => $bulan,
                'kelurahan' => $request->kelurahan[$i],
                'terlaksana_kampanye_pencegahan_stunting' => null,
                'keterangan_terlaksana_kampanye_pencegahan_stunting' => null,
                'desa_kelurahan_melaksanakan_stbm' => $request->desa_kelurahan_melaksanakan_stbm[$i],
                'publikasi_tingkat_kabupaten_kota' => $request->publikasi_tingkat_kabupaten_kota[$i],
                'terselenggara_audit_baduta_stunting' => $request->terselenggara_audit_baduta_stunting[$i],
                'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik' => $request->kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik[$i],
                'desa_kelurahan_terbebas_babs_odf' => $request->desa_kelurahan_terbebas_babs_odf[$i],
                'persentase_sasaran_pemahaman_stunting' => $request->persentase_sasaran_pemahaman_stunting[$i],
                'terpenuhi_standar_pemantauan_di_posyandu' => $request->terpenuhi_standar_pemantauan_di_posyandu[$i],
                'tersedia_bidan_desa_kelurahan' => $request->tersedia_bidan_desa_kelurahan[$i],
            ]);
        }

        /**
         * Submit data yang sudah disiapkan
         * Untuk data per kelurahan menggunakan perintah upsert untuk batch insert
         */
        $non_kelurahan_insert = Diskominfo::where('id', $request->id_report_non_kelurahan)->update($non_kelurahan_data);
        $per_kelurahan_insert = Diskominfo::upsert(
            $per_kelurahan_data,
            [],
            [
                'tahun',
                'bulan',
                'terlaksana_kampanye_pencegahan_stunting',
                'keterangan_terlaksana_kampanye_pencegahan_stunting',
                'desa_kelurahan_melaksanakan_stbm',
                'publikasi_tingkat_kabupaten_kota',
                'terselenggara_audit_baduta_stunting',
                'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik',
                'desa_kelurahan_terbebas_babs_odf',
                'persentase_sasaran_pemahaman_stunting',
                'terpenuhi_standar_pemantauan_di_posyandu',
                'tersedia_bidan_desa_kelurahan',
            ]
        );

        /**
         * Kembali ke halaman sebelumnya dengan pesan berhasil atau gagal
         */
        if ($non_kelurahan_data && $per_kelurahan_data) return redirect('/form/diskominfo')->with('success', 'Data berhasil disimpan.');

        return back()->with('error', 'Gagal menyimpan data')->withInput();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Diskominfo  $diskominfo
     * @return \Illuminate\Http\Response
     */
    public function destroy(Diskominfo $diskominfo)
    {
        //
    }
}
