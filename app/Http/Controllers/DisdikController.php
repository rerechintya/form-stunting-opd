<?php

namespace App\Http\Controllers;

use App\Models\Disdik;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class DisdikController extends Controller
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
        return view('pages.disdik', compact('kelurahan'));
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
            'juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan' => 'required',
            'ket_juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan' => 'nullable|string',
            'kelurahan' => 'required',
            'kelurahan.*' => 'sometimes|numeric',
            'juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting' => 'required',
            'juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting.*' => 'sometimes|numeric',
            'juml_ibu_hamil_dan_anak_baduta_tahun2020' => 'required',
            'juml_ibu_hamil_dan_anak_baduta_tahun2020.*' => 'sometimes|numeric',
            'cakupan_ortu_ikut_kls_parenting' => 'required',
            'cakupan_ortu_ikut_kls_parenting*' => 'sometimes|numeric',
            'juml_anak_usia_2_sd_6_terdaftar' => 'required',
            'juml_anak_usia_2_sd_6_terdaftar.*' => 'sometimes|numeric',
            'juml_seluruh_anak_usia_2_sd_6' => 'required',
            'juml_seluruh_anak_usia_2_sd_6.*' => 'sometimes|numeric',
            'cakupan_anak_usia_2_sd_6_terdaftar' => 'required',
            'cakupan_anak_usia_2_sd_6_terdaftar.*' => 'sometimes|numeric',
            'desa_yg_memiliki_guru_paud_terlatih_penanganan_stunting' => 'required',
            'desa_yg_memiliki_guru_paud_terlatih_penanganan_stunting.*' => 'sometimes|numeric',
            'lemb_paud_yg_mengembangkan_paudhi' => 'required',
            'lemb_paud_yg_mengembangkan_paudhi.*' => 'sometimes|numeric',
            'juml_kab_kot_yg_mem_tenaga_pel_penga_stimul_penang_stunting' => 'required',
            'juml_kab_kot_yg_mem_tenaga_pel_penga_stimul_penang_stunting.*' => 'sometimes|string',
            
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
        $existing_periode = Disdik::where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($existing_periode) {
            return back()->with('error', "Data pada periode yang sama ({$this->months[$bulan - 1]} {$tahun}) sudah ada, tidak dapat menyimpan data duplikat.")->withInput();
        }
        
        /**
         * Siapkan data yang berbentuk kolom isian status ya/tidak, contohnya pada OPD Diskominfo yaitu data pada sheet "Kominfo"
         */
        $non_kelurahan_data = [
            'tahun' => $tahun,
            'bulan' => $bulan,
            'juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan' => $request->juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan,
            'ket_juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan' => $request->ket_juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan
        ];

        /**
         * Siapkan data yang berbentuk per kelurahan, contohnya pada OPD Diskominfo yaitu data pada sheet "Kesehatan (Data Supply)"
         */
        $per_kelurahan_data = [];
        for ($i = 0; $i < count($request->juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting); $i++) {
            array_push($per_kelurahan_data, [
                'tahun' => $tahun,
                'bulan' => $bulan,
                'kelurahan' => $request->kelurahan[$i],
                'juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan' => null,
                'ket_juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan' => null,
                'juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting' => $request->juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting[$i],
                'juml_ibu_hamil_dan_anak_baduta_tahun2020' => $request->juml_ibu_hamil_dan_anak_baduta_tahun2020[$i],
                'cakupan_ortu_ikut_kls_parenting' => $request->cakupan_ortu_ikut_kls_parenting[$i],
                'juml_anak_usia_2_sd_6_terdaftar' => $request->juml_anak_usia_2_sd_6_terdaftar[$i],
                'juml_seluruh_anak_usia_2_sd_6' => $request->juml_seluruh_anak_usia_2_sd_6[$i],
                'cakupan_anak_usia_2_sd_6_terdaftar' => $request->cakupan_anak_usia_2_sd_6_terdaftar[$i],
                'desa_yg_memiliki_guru_paud_terlatih_penanganan_stunting' => $request->desa_yg_memiliki_guru_paud_terlatih_penanganan_stunting[$i],
                'cakupan_anak_usia_2_sd_6_terdaftar' => $request->cakupan_anak_usia_2_sd_6_terdaftar[$i],
                'lemb_paud_yg_mengembangkan_paudhi' => $request->lemb_paud_yg_mengembangkan_paudhi[$i],
                'juml_kab_kot_yg_mem_tenaga_pel_penga_stimul_penang_stunting' => $request->juml_kab_kot_yg_mem_tenaga_pel_penga_stimul_penang_stunting[$i],
        
            ]);
        }

        /**
         * Submit data yang sudah disiapkan
         * Untuk data per kelurahan menggunakan perintah upsert untuk batch insert
         */
        $non_kelurahan_insert = Disdik::create($non_kelurahan_data);
        $per_kelurahan_insert = Disdik::upsert($per_kelurahan_data, []);

        /**
         * Kembali ke halaman sebelumnya dengan pesan berhasil atau gagal
         */
        if ($non_kelurahan_data && $per_kelurahan_data) return redirect('/form/disdik')->with('success', 'Data berhasil disimpan.');

        return back()->with('error', 'Gagal menyimpan data')->withInput();

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Disdik  $disdik
     * @return \Illuminate\Http\Response
     */
    public function show(Disdik $disdik)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Disdik  $disdik
     * @return \Illuminate\Http\Response
     */
    public function edit(Disdik $disdik)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Disdik  $disdik
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Disdik $disdik)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Disdik  $disdik
     * @return \Illuminate\Http\Response
     */
    public function destroy(Disdik $disdik)
    {
        //
    }
}
