<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePenerbitTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('penerbit', function (Blueprint $table) {
            $table->increments('id_penerbit');
            $table->string('nama');
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
        Schema::dropIfExists('penerbit');
    }
}
