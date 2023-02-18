<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengarangTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengarang', function (Blueprint $table) {
            $table->increments('id_pengarang');
            $table->string('nama');            
            $table->string('nama_pena');            
            $table->string('email');
            $table->string('alamat');                        

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
        Schema::dropIfExists('pengarang');
    }
}
