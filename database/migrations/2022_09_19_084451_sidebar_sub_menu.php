<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SidebarSubMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidebar_sub_menu', function (Blueprint $table) {
            $table->id('sub_id');
            $table->foreignId('menu_id');
            $table->string('sub_name');
            $table->string('sub_inactive');
            $table->string('sub_order');
            $table->string('frmaction');
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
        Schema::dropIfExists('sidebar_sub_menu');
    }
}
