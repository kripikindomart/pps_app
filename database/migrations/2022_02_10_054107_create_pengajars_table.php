<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePengajarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pengajars', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->string('nik')->nullable();
            $table->string('nama');
            $table->string('email')->unique();
            $table->enum('status_pengajar', ['DOSEN TETAP', 'DOSEN TIDAK TETAP'])->default('DOSEN TETAP');
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('pendidikan_terakhir')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('photo')->nullable();
            $table->enum('jabatan_fungsional', ['-', 'ASISTEN AHLI', 'LEKTOR', 'LEKTOR KEPALA', 'GURU BESAR'])->nullable('-');
            $table->string('pangkat')->nullable();
            $table->string('golongan')->nullable();
            $table->enum('status_akun', ['Y', 'N'])->default('Y');
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
        Schema::dropIfExists('pengajars');
    }
}
