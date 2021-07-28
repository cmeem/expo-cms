<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();
            $table->integer('admin_id');
            $table->string('admin_username');
            $table->string('status');
            $table->integer('likes_count')->increment()->default(0);
            $table->integer('comments_count')->increment()->default(0);
            $table->integer('views_count')->increment()->default(0);
            $table->text('title');
            $table->string('category');
            $table->timestamps();
            $table->timestamp('deleted_at')->nullable();
            $table->longtext('tags');
            $table->longtext('attachments_names')->nullable();
            $table->longtext('attachments')->nullable();
            $table->longtext('content');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('posts');
    }
}
