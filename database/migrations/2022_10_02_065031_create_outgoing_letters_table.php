<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOutgoingLettersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('outgoing_letters', function (Blueprint $table) {
            $table->id();
            $table->string('number')->nullable();
            $table->string('subject');
            $table->date('date');
            $table->string('destination');
            $table->text('file');
            $table->tinyInteger('status')->default(0)->comment('0: Draft, 1: Acc Pelaksana Sekretariat, 2: Acc KTU Sekretaris, 3: Acc Sekretaris Universitas, 4: Acc Rektor');
            $table->text('description')->nullable();
            $table->boolean('revision')->nullable();
            $table->text('revision_description')->nullable();
            $table->foreignId('created_by')->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('updated_by')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('outgoing_letters');
    }
}
