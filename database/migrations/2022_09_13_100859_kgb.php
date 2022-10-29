<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class Kgb extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pegawai', function (Blueprint $table) {
            $table->bigIncrements('idpegawai');
            $table->bigInteger('nik')->unique();
            $table->String('nama');
            $table->enum('jk', ['l','p']);
            $table->date('skcpns');
            $table->timestamps();
        });

        Schema::create('kgb', function (Blueprint $table) {
            $table->bigIncrements('idkgb');
            $table->bigInteger('nik');
            $table->date('tanggalkgb');
            $table->timestamps();
        });


        Schema::create('admin', function (Blueprint $table) {
            $table->bigIncrements('idadmin');
            $table->String('username');
            $table->String('nama');
            $table->String('password');
            $table->timestamps();
        });

        Schema::create('p_kgb', function (Blueprint $table) {
            $table->bigIncrements('idpkgb');
            $table->char('tahunakhir', 4);
            $table->Integer('pertahun');
            $table->timestamps();
        });

        DB::table('p_kgb')->insert([
            'tahunakhir' => '2030',
            'pertahun' => 2,
        ]);

        DB::table('admin')->insert([
            'username' => 'admin',
            'nama' => 'admin',
            'password' => Hash::make('admin'),
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
