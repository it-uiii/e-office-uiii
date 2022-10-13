<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePerformanceReportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('performance_reports', function (Blueprint $table) {
            $table->id();
            $table->date('date');
            $table->tinyInteger('status')->default(0)->comment('0: Draft, 1: Acc KTU (Pimpinan)');
            $table->string('signature_reporter');
            $table->string('signature_leader')->nullable();
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
        Schema::dropIfExists('performance_reports');
    }
}
