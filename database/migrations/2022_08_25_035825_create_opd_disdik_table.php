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
        Schema::create('opd_disdik', function (Blueprint $table) {
            $table->id();
            
            $table->smallInteger('tahun');
            $table->tinyInteger('bulan');
            $table->foreignId('kelurahan')
                  ->nullable()
                  ->constrained('master_kelurahan')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');

            $table->integer('juml_ibu_hamil_dan_ortu_anak_usia_baduta_yg_ikut_kls_parenting')->nullable();
            $table->integer('juml_ibu_hamil_dan_anak_baduta_tahun2020')->nullable();
            $table->integer('cakupan_ortu_ikut_kls_parenting')->nullable();
            $table->integer('juml_anak_usia_2_sd_6_terdaftar')->nullable();
            $table->integer('juml_seluruh_anak_usia_2_sd_6')->nullable();
            $table->integer('cakupan_anak_usia_2_sd_6_terdaftar')->nullable();
            $table->integer('desa_yg_memiliki_guru_paud_terlatih_penanganan_stunting')->nullable();
            $table->integer('lemb_paud_yg_mengembangkan_paudhi')->nullable();
            $table->integer('juml_kab_kot_yg_mem_tenaga_pel_penga_stimul_penang_stunting')->nullable();
            $table->string('juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan')->nullable();
            $table->string('ket_juml_kab_kot_yg_memiliki_min_20_tenaga_pelatihan')->nullable();
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
        Schema::dropIfExists('opd_disdik');
    }
};
