<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Puskesmas extends Model
{
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'master_puskesmas';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'kecamatan',
        'puskesmas'
    ];

    public function kelurahan() {
        return $this->hasMany(Kelurahan::class, 'puskesmas');
    }

    public function parent_kecamatan() {
        return $this->belongsTo(Kecamatan::class, 'kecamatan');
    }
}
