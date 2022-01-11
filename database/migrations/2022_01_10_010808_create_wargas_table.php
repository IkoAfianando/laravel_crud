<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWargasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wargas', function (Blueprint $table) {
            $table->id();
            $table->string("name", 255);
            $table->string("foto");
            $table->string("alamat", 255);
            $table->dateTime("tanggal_lahir");
            $table->string("email", 255);
            $table->string("jenis_kelamin", 255);
            $table->string("status_pernikahan", 255);
            $table->string("status_warga",255);
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
        Schema::dropIfExists('wargas');
    }
}
