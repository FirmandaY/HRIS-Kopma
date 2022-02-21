<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAccMandivhrdIdToPeminjamanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->foreignId('acc_mandiv_id')->default(1)->after('user_id');
            $table->foreignId('acc_hrd_id')->default(4)->after('acc_mandiv_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('peminjaman', function (Blueprint $table) {
            $table->dropColumn('acc_mandiv_id');
            $table->dropColumn('acc_hrd_id');
        });
    }
}
