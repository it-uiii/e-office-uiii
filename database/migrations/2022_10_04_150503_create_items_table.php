<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('items', function (Blueprint $table) {
            $table->id();
            $table->string('nama_item')->nullable();
            $table->integer('nilai_perolehan')->nullable();
            $table->integer('jumlah_item')->nullable();
            $table->string('umur_ekonomis')->nullable();
            $table->string('images')->nullable();
            $table->foreignId('lokasi_id'); //lokasi model
            $table->foreignId('sumber_perolehan_id'); //sumber perolehan model
            $table->foreignId('golongan_item_id'); //golongan item model
            $table->foreignId('jenis_item_id'); //kategori (jenis item) model
            $table->foreignId('kelompok_item_id'); //supplier
            $table->date('tahun')->nullable(); //tahun model
            $table->string('supplier')->nullable();
            $table->string('brand')->nullable();
            $table->foreignId('supplier_id')->nullable(); //supplier model
            $table->foreignId('brand_id')->nullable(); //brand model
            $table->text('keterangan')->nullable();
            $table->text('umur_penyusutan')->nullable();
            $table->string('no_inventory')->nullable();
            $table->string('status')->nullable();
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
        Schema::dropIfExists('items');
    }
}
