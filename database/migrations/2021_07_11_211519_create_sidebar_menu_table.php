<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSidebarMenu extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sidebar_menu', function (Blueprint $table) {
            $table->id();
            $table->integer('parent_id');
            $table->string('title');
            $table->string('url')->nullable();
            $table->string('icon')->nullable();
            $table->string('order');
            $table->string('permission')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sidebar_menu');
    }
}
