<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePantisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('panti', function (Blueprint $table) {
            $table->id();
            $table->string('nama_panti');
            $table->string('alamat');
            $table->string('noTel_panti');
            $table->string('emailPanti');
            $table->integer('jumlah_anak');
            $table->integer('jumlah_pengurus');
            $table->longText('kebutuhan_panti');
            $table->string('sertifikat');
            $table->boolean('isVerified_ktp')->default(false);
            $table->boolean('isVerified_sertifikat')->default(false);
            $table->string('ktp');
            $table->timestamps();
            $table->unsignedBigInteger('user_id');

            $table->foreign('user_id')->references('id')->on('users');
            //relasi ke kegiatan
            //relasi ke user jika tipe sama dengan panti


        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('panti');
    }
}
