<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('opd_diskominfo', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('tahun');
            $table->tinyInteger('bulan');
            $table->foreignId('kelurahan')
                  ->nullable()
                  ->constrained('master_kelurahan')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            /**
             * Selebihnya disesuaikan seperti di excel, jangan diketik terlalu panjang
             * Untuk timestamps biarkan di bagian terakhir
             * 
             * Contoh:
             * $table->integer('publikasi_data_stunting_kab_kota');
             */
            $table->string('terlaksana_kampanye_pencegahan_stunting')->nullable();
            $table->string('keterangan_terlaksana_kampanye_pencegahan_stunting')->nullable();
            $table->integer('desa_kelurahan_melaksanakan_stbm')->nullable();
            $table->integer('publikasi_tingkat_kabupaten_kota')->nullable();
            $table->integer('terselenggara_audit_baduta_stunting')->nullable();
            $table->integer('kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik')->nullable();
            $table->integer('desa_kelurahan_terbebas_babs_odf')->nullable();
            $table->integer('persentase_sasaran_pemahaman_stunting')->nullable();
            $table->integer('terpenuhi_standar_pemantauan_di_posyandu')->nullable();
            $table->integer('tersedia_bidan_desa_kelurahan')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('opd_diskominfo');
    }
};
