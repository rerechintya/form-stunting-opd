<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinkes extends Model
{
    use HasFactory;

    protected $table = 'opd_dinkes';

    protected $fillable = [
        'tahun',
        'bulan',
        'kelurahan',
        // Sesuaikan dengan yg dideklarasikan di migration
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
        'jumlah_balita',
        'jumlah_balita_sangat_pendek',
        'jumlah_balita_pendek',
        'remaja_putri_status_anemia',
        'jumlah_remaja_putri_dapat_pelayanan',
        'presentase_remaja_putri_anemia',
        'remaja_putri_konsum_ttd',
        'jml_remaja_putri_seluruh',
        'presentasi_remaja_putri_konsum_ttd',
        'jml_calon_pengantin_dapat_ttd',
        'jml_calon_pengantin_seluruh',
        'presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus1',
        'calon_pasangan_dapat_pemeriksaan_3bln_pranikah',
        'jml_pasangan_yg_daftar_pranikah',
        'presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus2',
        'jml_ibu_hamil_dapat_asupan_gizi_pmt',
        'jml_keseluruhan_ibu_hamil_kek',
        'presentasi_layanan_tambahan_asupan_gizi_bumil_kek',
        'jml_ibu_hamil_konsum_tablet_min_90_tablet',
        'jml_ibu_hamil_dapat_ttd',
        'presentase_ibu_hamil_konsum_ttd_90_tablet_selama_hamil',
    ];
}
