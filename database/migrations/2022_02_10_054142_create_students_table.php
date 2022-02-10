<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->integer('program_studi_id')->nullable();
            $table->integer('kelas_id')->default('0');
            $table->integer('subkelas_id')->default('0');

            $table->integer('total_semester')->default('4');
            $table->string('code', 10)->unique();
            $table->string('nik', 75)->nullable();
            $table->string('nama', 75)->nullable();
            $table->string('email')->unique();
            $table->enum('status_mahasiswa', ['ACTIVE', 'PERMIT', 'INACTIVE', 'QUIT', 'MOVED', 'GRADUATED', 'DROPPED-OUT'])->default('ACTIVE');
            $table->enum('status_penerimaan', ['MAHASISWA BARU', 'PINDAHAN'])->default('MAHASISWA BARU');
            $table->enum('jenis_kelamin', ['L', 'P'])->default('L');
            $table->string('tempat_lahir')->nullable();
            $table->date('tanggal_lahir')->nullable();
            $table->text('alamat')->nullable();
            $table->string('kode_pos')->nullable();
            $table->string('no_hp')->nullable();
            $table->enum('pendidikan_terakhir', ['S1', 'S2', 'S3'])->default('S1');
            $table->string('asal_universitas_s1')->nullable();
            $table->string('asal_universitas_s2')->nullable();
            $table->string('asal_universitas_s3')->nullable();
            $table->string('gelar_terakhir')->nullable();
            $table->string('pekerjaan')->nullable();
            $table->string('alamat_pekerjaan')->nullable();
            $table->string('nama_ibu')->nullable();
            $table->string('photo')->nullable();
            $table->text('judul_thesis')->nullable();
            $table->enum('status_akun', ['Y', 'N'])->defult('N');
            $table->date('daftar_tgl')->nullable();
            $table->date('diterima_tgl')->nullable();
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
        Schema::dropIfExists('students');
    }
}
