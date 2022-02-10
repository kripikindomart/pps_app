<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKaryawansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('karyawans', function (Blueprint $table) {
            $table->id();
            $table->string('code', 10)->unique();
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->enum('status_karyawan', ['TETAP', 'KONTRAK', 'KONTRAK FAKULTAS'])->default('KONTRAK');
            $table->enum('jenis_kelamin', ['L', 'p'])->default('L');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->enum('pendidikan_terakhir', ['-', 'SD', 'SMP', 'SMA/SEDERAJAT', 'S1', 'S2', 'S3'])->default('-');
            $table->string('asal_pendidikan');
            $table->string('no_hp');
            $table->string('photo')->default('profile.png');
            $table->integer('program_studi_id');
            $table->integer('departement_id');
            $table->enum('status_akun', ['Y', 'N'])->default('N');
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
        Schema::dropIfExists('karyawans');
    }
}
