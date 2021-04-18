<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDonasisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('donasi', function (Blueprint $table) {
            $table->id();
            $table->string('jenis_donasi');
            $table->integer('jumlah_rp');
            $table->string('nama_barang');
            $table->integer('jumlah_barang');
            $table->date('tanggal_kirim');
            $table->string('kirim_lewat');
            $table->boolean('pending')->default(false);
            $table->timestamps();

            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');

            $table->unsignedBigInteger('panti_id');
            $table->foreign('panti_id')->references('id')->on('panti');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('donasi');
    }
}

