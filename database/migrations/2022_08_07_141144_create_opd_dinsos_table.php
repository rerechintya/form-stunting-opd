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
        Schema::create('opd_dinsos', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('tahun');
            $table->tinyInteger('bulan');
            $table->foreignId('kelurahan')
                  ->nullable()
                  ->constrained('master_kelurahan')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            
            $table->integer('Bantuan_PBI_kesehatan')->nullable();
            $table->integer('Jumlah_keluarga_miskin_rentan_bantuan_tunai')->nullable();
            $table->integer('Jumlah_keluarga_miskin_rentan_bantuan_sosial')->nullable();
            $table->integer('Jumlah_PKH_kesehatan_gizi')->nullable();
            $table->integer('Pus_status_miskin_tunai')->nullable();
            $table->integer('Jumlah_pus5')->nullable();
            $table->integer('Presentasepus_tunai_BST_KJS')->nullable();
            $table->integer('Pus_status_miskin_nontunai')->nullable();
            $table->integer('Jumlah_pus6')->nullable();
            $table->integer('Presentasepus_tunai_BPNT')->nullable();
            $table->integer('Pus_status_miskin_iurankesehatan')->nullable();
            $table->integer('Jumlah_pus7')->nullable();
            $table->integer('PresentaseRT_miskin_PBI')->nullable();
            $table->integer('Jumlah_KPM_PKH')->nullable();
            $table->integer('Jumlah_KPM_PKH_all')->nullable();
            $table->integer('Presentase_P2K2')->nullable();
            $table->integer('Jumlah_bantuan_pangan')->nullable();
            $table->integer('Jumlah_penerima_bantuan')->nullable();
            $table->integer('Presentase_KPM')->nullable();
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
        Schema::dropIfExists('opd_dinsos');
    }
};
