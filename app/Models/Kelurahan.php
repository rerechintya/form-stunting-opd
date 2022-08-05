<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kelurahan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_kelurahan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_bps',
        'kode_kemendagri',
        'kecamatan',
        'kelurahan',
        'puskesmas'
    ];

    public function parent_kecamatan() {
        return $this->belongsTo(Kecamatan::class, 'kecamatan');
    }

    public function parent_puskesmas() {
        return $this->belongsTo(Puskesmas::class, 'puskesmas');
    }
}
