<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePimpinansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pimpinans', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('username');
            $table->char('nrp', 14)->unique();
            $table->string('no_keputusan_pengangkatan')->nullable();
            $table->string('tgl_pengangkatan')->nullable();
            $table->date('tgl_masuk')->nullable();
            $table->date('tgl_lahir')->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('bank', 10)->nullable();
            $table->string('no_rek', 20)->nullable();
            $table->string('foto')->nullable();
            $table->string('email')->unique();
            $table->string('jabatan')->nullable();
            $table->boolean('status');
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->rememberToken();
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
        Schema::dropIfExists('pimpinans');
    }
}
