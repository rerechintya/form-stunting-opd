<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disdik extends Model
{
    use HasFactory;
    protected $table = 'opd_disdik';

    protected $fillable = [
        'tahun',
        'bulan',
        'kelurahan',
        // Sesuaikan dengan yg dideklarasikan di migration
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
        
    ];
}
