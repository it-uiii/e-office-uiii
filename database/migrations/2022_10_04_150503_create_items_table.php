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
            $table->foreignId('user_id');
            $table->string('nama_barang')->nullable();
            $table->integer('nilai_perolehan')->nullable();
            $table->string('jumlah_item')->nullable();
            $table->string('ukuran_item')->nullable();
            $table->string('image')->nullable();
            $table->foreignId('lokasi_id'); //lokasi model
            $table->foreignId('sumber_perolehan_id'); //sumber perolehan model
            $table->foreignId('golongan_item_id'); //golongan item model
            $table->foreignId('jenis_item_id'); //kategori (jenis item) model
            $table->foreignId('kelompok_item_id'); //supplier model
            $table->foreignId('detailbarang_id'); //detail barang model
            $table->date('tahun')->nullable(); //tahun model
            $table->foreignId('supplier_id')->nullable(); //supplier model
            $table->foreignId('brand_id')->nullable(); //brand model
            $table->text('keterangan')->nullable();
            $table->text('umur_penyusutan')->nullable();
            $table->string('no_inventory');
            $table->boolean('stock');
            $table->date('tanggal_invoice');
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
