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
        Schema::create('opd_dinkes', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('tahun');
            $table->tinyInteger('bulan');
            $table->foreignId('kelurahan')
                  ->nullable()
                  ->constrained('master_kelurahan')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('desa_kelurahan_melaksanakan_stbm')->nullable();
            $table->integer('publikasi_tingkat_kabupaten_kota')->nullable();
            $table->integer('terselenggara_audit_baduta_stunting')->nullable();
            $table->integer('kabupaten_kota_mengimplementasi_surveilans_gizi_elektronik')->nullable();
            $table->integer('desa_kelurahan_terbebas_babs_odf')->nullable();
            $table->integer('persentase_sasaran_pemahaman_stunting')->nullable();
            $table->integer('terpenuhi_standar_pemantauan_di_posyandu')->nullable();
            $table->integer('tersedia_bidan_desa_kelurahan')->nullable();
            $table->string('jumlah_balita')->nullable();
            $table->string('jumlah_balita_sangat_pendek')->nullable();
            $table->string('jumlah_balita_pendek')->nullable();
            $table->string('remaja_putri_status_anemia')->nullable();
            $table->string('jumlah_remaja_putri_dapat_pelayanan')->nullable();
            $table->string('presentase_remaja_putri_anemia')->nullable();
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
        Schema::dropIfExists('opd_dinkes');
    }
};
