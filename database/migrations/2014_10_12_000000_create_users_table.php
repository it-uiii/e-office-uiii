<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->foreignId('position_id')->nullable()->constrained('positions')->onUpdate('cascade')->onDelete('cascade');
            $table->foreignId('head_id')->nullable()->constrained('users')->onUpdate('cascade')->onDelete('cascade');
            $table->string('name');
            $table->string('username');
            $table->char('nrp', 14)->unique();
            $table->string('appointment_number')->nullable();
            $table->string('appointment_date')->nullable();
            $table->date('entry_date')->nullable();
            $table->date('birth_date')->nullable();
            $table->string('npwp', 20)->nullable();
            $table->string('bank', 10)->nullable();
            $table->string('account_number', 20)->nullable();
            $table->string('avatar')->nullable();
            $table->string('email')->unique();
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
        Schema::dropIfExists('users');
    }
}
