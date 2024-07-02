<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('mahasiswa', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_user');
            $table->string('nama_mahasiswa');
            $table->string('nim_mahasiswa')->unique();
            $table->year('angkatan_mahasiswa');
            $table->string('semester_mahasiswa');
            $table->string('jenjang_mahasiswa');
            $table->unsignedBigInteger('id_program_studi');
            $table->enum('jalur_masuk', ['PSB/PMDK/SNMPN/SNMPTN', 'UMPN PSDKU', 'UMPN/SBMPN/SBMPTN', 'Mandiri-1', 'Mandiri-2']);
            $table->text('alamat_ortu')->nullable();
            $table->string('no_hp_aktif')->nullable();
            $table->string('no_telp_ayah')->nullable();
            $table->enum('status_ortu', ['Duda', 'Janda', 'Lengkap'])->nullable();
            $table->string('pekerjaan_ayah')->nullable();
            $table->string('pekerjaan_ibu')->nullable();
            $table->integer('jml_tanggungan')->nullable();
            $table->integer('anak_di_tanggung')->nullable();
            $table->double('penghasilan_ayah')->nullable();
            $table->double('penghasilan_ibu')->nullable();
            $table->double('penghasilan_gabungan')->nullable();
            $table->double('besaran_pln')->nullable();
            $table->double('besaran_pdam')->nullable();
            $table->double('pajak_mobil')->nullable();
            $table->double('pajak_motor')->nullable();
            $table->unsignedBigInteger('id_kelompok_ukt')->nullable();
            $table->enum('status_verifikasi', ['Diverifikasi', 'Pending', 'Proses Diverifikasi', 'Ditolak'])->default('Pending');
            $table->json('histori_pengajuan_mahasiswa')->nullable();
            $table->unsignedBigInteger('id_kelompok_ukt_baru')->nullable();
            $table->enum('status_verifikasi_perhitungan', ['Diverifikasi', 'Pending', 'Ditolak'])->default('Pending');
            $table->unsignedBigInteger('id_periode');
            $table->text('histori_perhitungan_mahasiswa')->nullable();
            $table->string('foto_mahasiswa')->nullable();
            $table->string('foto_pekerjaan_ayah')->nullable();
            $table->string('foto_pekerjaan_ibu')->nullable();
            $table->string('foto_keluarga')->nullable();
            $table->string('foto_penghasilan_ayah')->nullable();
            $table->string('foto_penghasilan_ibu')->nullable();
            $table->string('foto_penghasilan_gabungan')->nullable();
            $table->string('foto_pembayaran_pln')->nullable();
            $table->string('foto_pembayaran_pdam')->nullable();
            $table->string('foto_pajak_mobil')->nullable();
            $table->string('foto_pajak_motor')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->foreign('id_user')->references('id')->on('users')->restrictOnDelete();
            $table->foreign('id_program_studi')->references('id')->on('program_studi')->restrictOnDelete();
            $table->foreign('id_periode')->references('id')->on('periode')->restrictOnDelete();
            $table->foreign('id_kelompok_ukt')->references('id')->on('kelompok_ukt')->restrictOnDelete();
            $table->foreign('id_kelompok_ukt_baru')->references('id')->on('kelompok_ukt')->restrictOnDelete();
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
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
        Schema::dropIfExists('mahasiswa');
    }
};