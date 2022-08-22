<?php

namespace App\Http\Controllers;

use App\Models\Diskominfo;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

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
        return view('pages.diskominfo', compact('kelurahan'));
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
            // 'kelurahan.*' => 'sometimes|numeric',
            'desa_kelurahan_melaksanakan_stbm' => 'required',
            // 'desa_kelurahan_melaksanakan_stbm.*' => 'sometimes|numeric',
            'publikasi_tingkat_kabupaten_kota' => 'required',
            // 'publikasi_tingkat_kabupaten_kota.*' => 'sometimes|numeric',
            'terselenggara_audit_baduta_stunting' => 'required',
            // 'terselenggara_audit_baduta_stunting.*' => 'sometimes|numeric',
            'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik' => 'required',
            // 'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik.*' => 'sometimes|numeric',
            'desa_kelurahan_terbebas_babs_odf' => 'required',
            // 'desa_kelurahan_terbebas_babs_odf.*' => 'sometimes|numeric',
            'persentase_sasaran_pemahaman_stunting' => 'required',
            // 'persentase_sasaran_pemahaman_stunting.*' => 'sometimes|numeric',
            'terpenuhi_standar_pemantauan_di_posyandu' => 'required',
            // 'terpenuhi_standar_pemantauan_di_posyandu.*' => 'sometimes|numeric',
            'tersedia_bidan_desa_kelurahan' => 'required',
            // 'tersedia_bidan_desa_kelurahan.*' => 'sometimes|numeric',
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
     * Display the specified resource.
     *
     * @param  \App\Models\Diskominfo  $diskominfo
     * @return \Illuminate\Http\Response
     */
    public function show(Diskominfo $diskominfo)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Diskominfo  $diskominfo
     * @return \Illuminate\Http\Response
     */
    public function edit(Diskominfo $diskominfo)
    {
        //
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
        //
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
