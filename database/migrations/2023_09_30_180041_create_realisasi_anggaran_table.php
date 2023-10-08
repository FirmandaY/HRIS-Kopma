<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisasiAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('realisasi_anggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->string('slug', 191);
            $table->string('email');
            $table->string('nama_user');
            $table->string('bidang');
            $table->string('no_telp');
            $table->string('no_spj');
            $table->string('foto_spj');
            $table->string('file_bukti_transaksi');
            $table->string('file_realisasi');
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
        Schema::dropIfExists('realisasi_anggaran');
    }
}
