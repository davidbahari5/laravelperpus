<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesan', function (Blueprint $table) {
            $table->increments('id_pesan');
            $table->integer('id_anggota')->unsigned()->nullable();
            $table->foreign('id_anggota')->references('id_anggota')->on('anggota');
            $table->integer('id_buku')->unsigned()->nullable();
            $table->foreign('id_buku')->references('id_buku')->on('buku');
            $table->string('email_penyewa');            
            $table->timestamp('tanggal')->useCurrent();
            $table->integer('status')->default(0);

            $table->smallInteger('soft_delete')->default(0);
            $table->timestamps(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pesan');
    }
}
