<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Kecamatan extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_kecamatan';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kode_bps',
        'kode_kemendagri',
        'kecamatan'
    ];

    /**
     * Get every kelurahan in a kecamatan
     */
    public function kelurahan() {
        return $this->hasMany(Kelurahan::class, 'kecamatan');
    }
}
