<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRulesSopsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rules_sops', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_rules_id');
            $table->string('title');
            $table->string('nomor')->nullable();
            $table->date('tanggal_penetapan')->nullable();
            $table->date('tanggal_berlaku')->nullable();
            $table->date('tanggal_berakhir')->nullable();
            $table->boolean('status');
            $table->text('deskripsi')->nullable();
            $table->string('pdf')->nullable();
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
        Schema::dropIfExists('rules_sops');
    }
}
