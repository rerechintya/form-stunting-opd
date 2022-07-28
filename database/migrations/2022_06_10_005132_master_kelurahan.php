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
        Schema::create('master_kelurahan', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan')
                  ->constrained('master_kecamatan')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->bigInteger('kode_bps')->unique();
            $table->bigInteger('kode_kemendagri')->unique();
            $table->string('kelurahan');
            $table->foreignId('puskesmas')
                  ->constrained('master_puskesmas')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
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
        Schema::dropIfExists('master_kelurahan');
    }
};
