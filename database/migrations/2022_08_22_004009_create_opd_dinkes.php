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
            $table->string('remaja_putri_konsum_ttd')->nullable();
            $table->string('jml_remaja_putri_seluruh')->nullable();
            $table->string('presentasi_remaja_putri_konsum_ttd')->nullable();
            $table->string('jml_calon_pengantin_dapat_ttd')->nullable();
            $table->string('jml_calon_pengantin_seluruh')->nullable();
            $table->string('presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus1')->nullable();
            $table->string('calon_pasangan_dapat_pemeriksaan_3bln_pranikah')->nullable();
            $table->string('jml_pasangan_yg_daftar_pranikah')->nullable();
            $table->string('presentase_calon_pengantin_terima_ttd_dlm_kurun_waktu_sama_pus2')->nullable();
            $table->string('jml_ibu_hamil_dapat_asupan_gizi_pmt')->nullable();
            $table->string('jml_keseluruhan_ibu_hamil_kek')->nullable();
            $table->string('presentasi_layanan_tambahan_asupan_gizi_bumil_kek')->nullable();
            $table->string('jml_ibu_hamil_konsum_tablet_min_90_tablet')->nullable();
            $table->string('jml_ibu_hamil_dapat_ttd')->nullable();
            $table->string('presentase_ibu_hamil_konsum_ttd_90_tablet_selama_hamil')->nullable();
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
