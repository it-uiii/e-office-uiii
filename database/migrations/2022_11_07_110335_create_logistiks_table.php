<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLogistiksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('logistiks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_barang');
            $table->string('satuan');
            $table->integer('harga_satuan');
            $table->float('pajak');
            $table->integer('harga_bef_pajak');
            $table->integer('harga_aft_pajak');
            $table->integer('sisa');
            $table->integer('saldo_akhir');
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
        Schema::dropIfExists('logistiks');
    }
}
