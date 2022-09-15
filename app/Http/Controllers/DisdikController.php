<?php

namespace App\Http\Controllers;

use App\Models\Disdik;
use App\Models\Kelurahan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
        $report_history = Disdik::select(DB::raw('MAX(id), tahun, bulan'))->groupBy('bulan', 'tahun')->get();
        extract(get_object_vars($this));

        return view('pages.disdik', compact('kelurahan', 'report_history', 'months'));
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
    public function edit(Disdik $disdik, $params)
    {
        $periods = explode("-", $params);
        $reports = Disdik::where('bulan', $periods[1])->where('tahun', $periods[0])->get()->toArray();
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
        
        return view('pages.disdik-edit', compact('kelurahan', 'report_non_kelurahan', 'report_kelurahan', 'column_kelurahan_only'));
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
        /**
         * Validasi kolom yang akan diproses
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
         * Pada proses ini, tambahkan kolom id seperti yg dapat dilihat pada contoh di bawah
         * Value untuk kolom id didapat dari hidden input pada form edit, silakan cek form edit dan cari textfield "id_report_kelurahan[]"
         */
        $per_kelurahan_data = [];
        for ($i = 0; $i < count($request->juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting); $i++) {
            array_push($per_kelurahan_data, [
                'id' => $request->id_report_kelurahan[$i],
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
         * Update data yang sudah disiapkan
         * Untuk data non kelurahan (kolom isian ya/tidak) menggunakan perintah where lalu update
         * Parameter id_report_non_kelurahan dapat dilihat pada form edit, silakan cek form edit dan cari textfield "id_report_non_kelurahan"
         * Untuk data per kelurahan menggunakan perintah upsert untuk batch update, dengan 3 parameter
         * Parameter pertama yaitu data yg sudah disiapkan dan akan diupdate
         * Parameter kedua yaitu kolom yg harus bersifat unique (biarkan kosong)
         * Parameter ketiga yaitu kolom yang perlu diupdate apabila ada data yg sama
         * (silakan isikan sesuai dengan kolom pada OPD yang kalian kerjakan, kolom yg sama untuk semua OPD hanya tahun dan bulan)
         */
        $non_kelurahan_insert = Disdik::where('id', $request->id_report_non_kelurahan)->update($non_kelurahan_data);
        $per_kelurahan_insert = Disdik::upsert(
            $per_kelurahan_data,
            [],
            [
                'tahun',
                'bulan',
                'juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting',
                'juml_ibu_hamil_dan_anak_baduta_tahun2020',
                'cakupan_ortu_ikut_kls_parenting',
                'juml_anak_usia_2_sd_6_terdaftar',
                'juml_seluruh_anak_usia_2_sd_6',
                'cakupan_anak_usia_2_sd_6_terdaftar',
                'desa_yg_memiliki_guru_paud_terlatih_penanganan_stunting',
                'lemb_paud_yg_mengembangkan_paudhi',
                'juml_kab_kot_yg_mem_tenaga_pel_penga_stimul_penang_stunting',
                'juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan',
                'ket_juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan'
            ]
        );

        /**
         * Kembali ke halaman sebelumnya dengan pesan berhasil atau gagal
         */
        if ($non_kelurahan_data && $per_kelurahan_data) return redirect('/form/disdik')->with('success', 'Data berhasil disimpan.');

        return back()->with('error', 'Gagal menyimpan data')->withInput();
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
