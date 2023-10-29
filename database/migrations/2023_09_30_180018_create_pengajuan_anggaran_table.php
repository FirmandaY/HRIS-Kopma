<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajuanAnggaranTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajuan_anggaran', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id');
            $table->foreignId('acc_adminkeu_id')->default(1);
            $table->string('slug', 191);
            $table->string('email');
            $table->string('nama_user');
            $table->string('bidang');
            $table->string('no_tlp');
            $table->string('file_anggaran');
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
        Schema::dropIfExists('pengajuan_anggaran');
    }
}
