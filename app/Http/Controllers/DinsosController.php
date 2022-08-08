<?php

namespace App\Http\Controllers;

use App\Models\Dinsos;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class DinsosController extends Controller
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
        return view('pages.dinsos', compact('kelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
            'Pus_status_miskin_tunai' => 'required',
            'Pus_status_miskin_tunai.*' => 'sometimes|numeric',
            'Jumlah_pus5' => 'required',
            'Jumlah_pus5.*' => 'sometimes|numeric',
            'Presentasepus_tunai_BST_KJS' => 'required',
            'Presentasepus_tunai_BST_KJS.*' => 'sometimes|numeric',
            'Pus_status_miskin_nontunai' => 'required',
            'Pus_status_miskin_nontunai.*' => 'sometimes|numeric',
            'Jumlah_pus6' => 'required',
            'Jumlah_pus6.*' => 'sometimes|numeric',
            'Presentasepus_tunai_BPNT' => 'required',
            'Presentasepus_tunai_BPNT.*' => 'sometimes|numeric',
            'Pus_status_miskin_iurankesehatan' => 'required',
            'Pus_status_miskin_iurankesehatan.*' => 'sometimes|numeric',
            'Jumlah_pus7' => 'required',
            'Jumlah_pus7.*' => 'sometimes|numeric',
            'PresentaseRT_miskin_PBI' => 'required',
            'PresentaseRT_miskin_PBI.*' => 'sometimes|numeric',
            'Jumlah_KPM_PKH' => 'required',
            'Jumlah_KPM_PKH.*' => 'sometimes|numeric',
            'Jumlah_KPM_PKH_all' => 'required',
            'Jumlah_KPM_PKH_all.*' => 'sometimes|numeric',
            'Presentase_P2K2' => 'required',
            'Presentase_P2K2.*' => 'sometimes|numeric',
            'Jumlah_bantuan_pangan' => 'required',
            'Jumlah_bantuan_pangan.*' => 'sometimes|numeric',
            'Jumlah_penerima_bantuan' => 'required',
            'Jumlah_penerima_bantuan.*' => 'sometimes|numeric',
            'Presentase_KPM' => 'required',
            'Presentase_KPM.*' => 'sometimes|numeric',
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
        $existing_periode = Dinsos::where('tahun', $tahun)->where('bulan', $bulan)->first();
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
                'Pus_status_miskin_tunai' => $request->Pus_status_miskin_tunai[$i],
                'Jumlah_pus5' => $request->Jumlah_pus5[$i],
                'Presentasepus_tunai_BST_KJS' => $request->Presentasepus_tunai_BST_KJS[$i],
                'Pus_status_miskin_nontunai' => $request->Pus_status_miskin_nontunai[$i],
                'Jumlah_pus6' => $request->Jumlah_pus6[$i],
                'Presentasepus_tunai_BPNT' => $request->Presentasepus_tunai_BPNT[$i],
                'Pus_status_miskin_iurankesehatan' => $request->Pus_status_miskin_iurankesehatan[$i],
                'Jumlah_pus7' => $request->Jumlah_pus7[$i],
                'PresentaseRT_miskin_PBI' => $request->PresentaseRT_miskin_PBI[$i],
                'Jumlah_KPM_PKH' => $request->Jumlah_KPM_PKH[$i],
                'Jumlah_KPM_PKH_all' => $request->Jumlah_KPM_PKH_all[$i],
                'Presentase_P2K2' => $request->Presentase_P2K2[$i],
                'Jumlah_bantuan_pangan' => $request->Jumlah_bantuan_pangan[$i],
                'Jumlah_penerima_bantuan' => $request->Jumlah_penerima_bantuan[$i],
                'Presentase_KPM' => $request->Presentase_KPM[$i],
            ]);
        }

        /**
         * Submit data yang sudah disiapkan
         * Untuk data per kelurahan menggunakan perintah upsert untuk batch insert
         */
        $non_kelurahan_insert = Dinsos::create($non_kelurahan_data);
        $per_kelurahan_insert = Dinsos::upsert($per_kelurahan_data, []);

        /**
         * Kembali ke halaman sebelumnya dengan pesan berhasil atau gagal
         */
        if ($non_kelurahan_data && $per_kelurahan_data) return redirect('/form/dinsos')->with('success', 'Data berhasil disimpan.');

        return back()->with('error', 'Gagal menyimpan data')->withInput();

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
