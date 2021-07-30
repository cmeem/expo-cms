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
            $table->string('status')->default('inactive');
            $table->string('name');
            $table->string('social_id')->nullable();
            $table->string('email')->unique();
            $table->integer('views_count')->increment();
            $table->integer('likes_count')->increment();
            $table->integer('comments_count')->increment();
            $table->string('avatar')->default('/img/avatars/profile.png');;
            $table->string('avatar_original')->default('/img/avatars/profile.png');;
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password')->nullable();
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
