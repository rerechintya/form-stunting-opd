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
            'remaja_putri_konsum_ttd' => 'required',
            'remaja_putri_konsum_ttd.*' => 'sometimes|numeric',
            'jml_remaja_putri_seluruh' => 'required',
            'jml_remaja_putri_seluruh.*' => 'sometimes|numeric',
            'presentasi_remaja_putri_konsum_ttd' => 'required',
            'presentasi_remaja_putri_konsum_ttd.*' => 'sometimes|numeric',
            'jml_calon_pengantin_dapat_ttd' => 'required',
            'jml_calon_pengantin_dapat_ttd.*' => 'sometimes|numeric',
            'jml_calon_pengantin_seluruh' => 'required',
            'jml_calon_pengantin_seluruh.*' => 'sometimes|numeric',
            'presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus1' => 'required',
            'presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus1.*' => 'sometimes|numeric',
            'calon_pasangan_dapat_pemeriksaan_3bln_pranikah' => 'required',
            'calon_pasangan_dapat_pemeriksaan_3bln_pranikah.*' => 'sometimes|numeric',
            'jml_pasangan_yg_daftar_pranikah' => 'required',
            'jml_pasangan_yg_daftar_pranikah.*' => 'sometimes|numeric',
            'presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus2' => 'required',
            'presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus2.*' => 'sometimes|numeric',
            'jml_ibu_hamil_dapat_asupan_gizi_pmt' => 'required',
            'jml_ibu_hamil_dapat_asupan_gizi_pmt.*' => 'sometimes|numeric',
            'jml_keseluruhan_ibu_hamil_kek' => 'required',
            'jml_keseluruhan_ibu_hamil_kek.*' => 'sometimes|numeric',
            'presentasi_layanan_tambahan_asupan_gizi_bumil_kek' => 'required',
            'presentasi_layanan_tambahan_asupan_gizi_bumil_kek.*' => 'sometimes|numeric',
            'jml_ibu_hamil_konsum_tablet_min_90_tablet' => 'required',
            'jml_ibu_hamil_konsum_tablet_min_90_tablet.*' => 'sometimes|numeric',
            'jml_ibu_hamil_dapat_ttd' => 'required',
            'jml_ibu_hamil_dapat_ttd.*' => 'sometimes|numeric',
            'presentase_ibu_hamil_konsum_ttd_90_tablet_selama_hamil' => 'required',
            'presentase_ibu_hamil_konsum_ttd_90_tablet_selama_hamil.*' => 'sometimes|numeric',
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
                'jumlah_balita' => $request->jumlah_balita[$i],
                'jumlah_balita_sangat_pendek' => $request->jumlah_balita_sangat_pendek[$i], 
                'jumlah_balita_pendek' => $request->jumlah_balita_pendek[$i],
                'remaja_putri_status_anemia' => $request->remaja_putri_status_anemia[$i],
                'jumlah_remaja_putri_dapat_pelayanan' => $request->jumlah_remaja_putri_dapat_pelayanan[$i],
                'presentase_remaja_putri_anemia' => $request->presentase_remaja_putri_anemia[$i],
                'remaja_putri_konsum_ttd' => $request->remaja_putri_konsum_ttd[$i],
                'jml_remaja_putri_seluruh' => $request->jml_remaja_putri_seluruh[$i],
                'presentasi_remaja_putri_konsum_ttd' => $request->presentasi_remaja_putri_konsum_ttd[$i],
                'jml_calon_pengantin_dapat_ttd' => $request->jml_calon_pengantin_dapat_ttd[$i],
                'jml_calon_pengantin_seluruh' => $request->jml_calon_pengantin_dapat_ttd[$i],
                'presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus1' => $request->presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus1[$i],
                'calon_pasangan_dapat_pemeriksaan_3bln_pranikah' => $request->calon_pasangan_dapat_pemeriksaan_3bln_pranikah[$i],
                'jml_pasangan_yg_daftar_pranikah' => $request->jml_pasangan_yg_daftar_pranikah[$i],
                'presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus2' => $request->presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus2[$i],
                'jml_ibu_hamil_dapat_asupan_gizi_pmt' => $request->jml_ibu_hamil_dapat_asupan_gizi_pmt[$i],
                'jml_keseluruhan_ibu_hamil_kek' => $request->jml_keseluruhan_ibu_hamil_kek[$i],
                'presentasi_layanan_tambahan_asupan_gizi_bumil_kek' => $request->presentasi_layanan_tambahan_asupan_gizi_bumil_kek[$i],
                'jml_ibu_hamil_konsum_tablet_min_90_tablet' => $request->jml_ibu_hamil_konsum_tablet_min_90_tablet[$i],
                'jml_ibu_hamil_dapat_ttd' => $request->jml_ibu_hamil_dapat_ttd[$i],
                'presentase_ibu_hamil_konsum_ttd_90_tablet_selama_hamil' => $request->presentase_ibu_hamil_konsum_ttd_90_tablet_selama_hamil[$i],
            ]);
        }

        /**
         * Submit data yang sudah disiapkan
         * Untuk data per kelurahan menggunakan perintah upsert untuk batch insert
         */
        $per_kelurahan_insert = Dinkes::upsert($per_kelurahan_data, []);

        /**
         * Kembali ke halaman sebelumnya dengan pesan berhasil atau gagal
         */
        if ($per_kelurahan_data) return redirect('/form/dinkes')->with('success', 'Data berhasil disimpan.');

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
