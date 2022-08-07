<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dinsos extends Model
{
    use HasFactory;
    protected $table = 'opd_diskominfo';

    protected $fillable = [
        'tahun',
        'bulan',
        'kelurahan',
        // Sesuaikan dengan yg dideklarasikan di migration
        'terlaksana_kampanye_pencegahan_stunting',
        'keterangan_terlaksana_kampanye_pencegahan_stunting',
        'Pus_status_miskin_tunai',
        'Jumlah_pus5',
        'Presentasepus_tunai_BST_KJS',
        'Pus_status_miskin_nontunai',
        'Jumlah_pus6',
        'Presentasepus_tunai_BPNT',
        'Pus_status_miskin_iurankesehatan',
        'Jumlah_pus7',
        'PresentaseRT_miskin_PBI',
        'Jumlah_KPM_PKH',
        'Jumlah_KPM_PKH_all',
        'Presentase_P2K2',
        'Jumlah_bantuan_pangan',
        'Jumlah_penerima_bantuan',
        'Presentase_KPM'
    ];
}
