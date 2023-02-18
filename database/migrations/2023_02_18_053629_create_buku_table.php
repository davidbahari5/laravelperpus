<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBukuTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('buku', function (Blueprint $table) {
            $table->increments('id_buku');
            $table->string('judul');
            $table->integer('id_pengarang')->unsigned()->nullable();
            $table->foreign('id_pengarang')->references('id_pengarang')->on('pengarang');
            $table->integer('id_penerbit')->unsigned()->nullable();
            $table->foreign('id_penerbit')->references('id_penerbit')->on('penerbit');            
            $table->string('keterangan');
            $table->integer('stock');
            $table->integer('status')->default(0);
            $table->string('gambar');

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
        Schema::dropIfExists('buku');
    }
}
