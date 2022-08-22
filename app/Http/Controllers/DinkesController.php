<?php

namespace App\Http\Controllers;

use App\Models\Dinkes;
use App\Models\Kelurahan;
use Illuminate\Http\Request;

class DinkesController extends Controller
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
        return view('pages.dinkes', compact('kelurahan'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        /**
         * Validasi kolom input yang akan diproses
         */
        $validation = $request->validate([
            'date' => 'required',
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
            'jumlah_balita' => 'required',
            'jumlah_balita.*' => 'sometimes|numeric',
            'jumlah_balita_sangat_pendek' => 'required',
            'jumlah_balita_sangat_pendek.*' => 'sometimes|numeric',
            'jumlah_balita_pendek' => 'required',
            'jumlah_balita_pendek.*' => 'sometimes|numeric',
            'remaja_putri_status_anemia' => 'required',
            'remaja_putri_status_anemia.*' => 'sometimes|numeric',
            'jumlah_remaja_putri_dapat_pelayanan' => 'required',
            'jumlah_remaja_putri_dapat_pelayanan.*' => 'sometimes|numeric',
            'presentase_remaja_putri_anemia' => 'required',
            'presentase_remaja_putri_anemia.*' => 'sometimes|numeric',
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
        $existing_periode = Dinkes::where('tahun', $tahun)->where('bulan', $bulan)->first();
        if ($existing_periode) {
            return back()->with('error', "Data pada periode yang sama ({$this->months[$bulan - 1]} {$tahun}) sudah ada, tidak dapat menyimpan data duplikat.")->withInput();
        }
        
        /**
         * Siapkan data yang berbentuk per kelurahan, contohnya pada OPD Diskominfo yaitu data pada sheet "Kesehatan (Data Supply)"
         */
        $per_kelurahan_data = [];
        for ($i = 0; $i < count($request->desa_kelurahan_melaksanakan_stbm); $i++) {
            array_push($per_kelurahan_data, [
                'tahun' => $tahun,
                'bulan' => $bulan,
                'kelurahan' => $request->kelurahan[$i],
                'desa_kelurahan_melaksanakan_stbm' => $request->desa_kelurahan_melaksanakan_stbm[$i],
                'publikasi_tingkat_kabupaten_kota' => $request->publikasi_tingkat_kabupaten_kota[$i],
                'terselenggara_audit_baduta_stunting' => $request->terselenggara_audit_baduta_stunting[$i],
                'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik' => $request->kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik[$i],
                'desa_kelurahan_terbebas_babs_odf' => $request->desa_kelurahan_terbebas_babs_odf[$i],
                'persentase_sasaran_pemahaman_stunting' => $request->persentase_sasaran_pemahaman_stunting[$i],
                'terpenuhi_standar_pemantauan_di_posyandu' => $request->terpenuhi_standar_pemantauan_di_posyandu[$i],
                'tersedia_bidan_desa_kelurahan' => $request->tersedia_bidan_desa_kelurahan[$i],
                'jumlah_balita' => null,
                'jumlah_balita_sangat_pendek' => null,
                'jumlah_balita_pendek' => null,
                'remaja_putri_status_anemia' => null,
                'jumlah_remaja_putri_dapat_pelayanan' => null,
                'presentase_remaja_putri_anemia' => null,
            ]);
        }

        $data_stunting_balita = [];
        for ($i = 0; $i < count($request->jumlah_balita); $i++){
            array_push($data_stunting_balita, [
                'tahun' => $tahun,
                'bulan' => $bulan,
                'kelurahan' => $request->kelurahan[$i],
                'desa_kelurahan_melaksanakan_stbm' => null,
                'publikasi_tingkat_kabupaten_kota' => null,
                'terselenggara_audit_baduta_stunting' => null,
                'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik' => null,
                'desa_kelurahan_terbebas_babs_odf' => null,
                'persentase_sasaran_pemahaman_stunting' => null,
                'terpenuhi_standar_pemantauan_di_posyandu' => null,
                'tersedia_bidan_desa_kelurahan' => null,
                'jumlah_balita' => $request->jumlah_balita[$i],
                'jumlah_balita_sangat_pendek' => $request->jumlah_balita_sangat_pendek[$i], 
                'jumlah_balita_pendek' => $request->jumlah_balita_pendek[$i],
                'remaja_putri_status_anemia' => null,
                'jumlah_remaja_putri_dapat_pelayanan' => null,
                'presentase_remaja_putri_anemia' => null,
            ]);
        }

        $remaja_putri_anemia = [];
        for ($i = 0; $i < count($request->remaja_putri_status_anemia); $i++){
            array_push($remaja_putri_anemia, [
                'tahun' => $tahun,
                'bulan' => $bulan,
                'kelurahan' => $request->kelurahan[$i],
                'desa_kelurahan_melaksanakan_stbm' => null,
                'publikasi_tingkat_kabupaten_kota' => null,
                'terselenggara_audit_baduta_stunting' => null,
                'kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik' => null,
                'desa_kelurahan_terbebas_babs_odf' => null,
                'persentase_sasaran_pemahaman_stunting' => null,
                'terpenuhi_standar_pemantauan_di_posyandu' => null,
                'tersedia_bidan_desa_kelurahan' => null,
                'jumlah_balita' => null,
                'jumlah_balita_sangat_pendek' => null,
                'jumlah_balita_pendek' => null,
                'remaja_putri_status_anemia' => $request->remaja_putri_status_anemia[$i],
                'jumlah_remaja_putri_dapat_pelayanan' => $request->jumlah_remaja_putri_dapat_pelayanan[$i],
                'presentase_remaja_putri_anemia' => $request->presentase_remaja_putri_anemia[$i],
            ]);
        }

        /**
         * Submit data yang sudah disiapkan
         * Untuk data per kelurahan menggunakan perintah upsert untuk batch insert
         */
        $per_kelurahan_insert = Dinkes::upsert($per_kelurahan_data, []);
        $data_stunting_balita_insert = Dinkes::upsert($data_stunting_balita, []);
        $remaja_putri_anemia_insert = Dinkes::upsert($remaja_putri_anemia, []);

        /**
         * Kembali ke halaman sebelumnya dengan pesan berhasil atau gagal
         */
        if ($per_kelurahan_data && $data_stunting_balita && $remaja_putri_anemia) return redirect('/form/dinkes')->with('success', 'Data berhasil disimpan.');

        return back()->with('error', 'Gagal menyimpan data')->withInput();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Dinkes  $dinkes
     * @return \Illuminate\Http\Response
     */
    public function show(Dinkes $dinkes)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Dinkes  $dinkes
     * @return \Illuminate\Http\Response
     */
    public function edit(Dinkes $dinkes)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Dinkes  $dinkes
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Dinkes $dinkes)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Dinkes  $dinkes
     * @return \Illuminate\Http\Response
     */
    public function destroy(Dinkes $dinkes)
    {
        //
    }
}
