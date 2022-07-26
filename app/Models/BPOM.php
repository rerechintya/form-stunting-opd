<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BPOM extends Model
{
    use HasFactory;

    protected $table = 'opd_bpom';

    protected $fillable = [
        'tahun',
        'bulan',
        // Sesuaikan dengan yg dideklarasikan di migration
    ];
    
}
