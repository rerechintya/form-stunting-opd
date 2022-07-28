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
        Schema::create('master_puskesmas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kecamatan')
                  ->constrained('master_kecamatan')
                  ->onUpdate('cascade')
                  ->onDelete('restrict');
            $table->string('puskesmas');
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
        Schema::dropIfExists('master_puskesmas');
    }
};
