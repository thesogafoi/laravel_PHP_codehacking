<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsRepliesControllersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comment_replies', function (Blueprint $table) {
			$table->increments('id');
			$table->integer('comment_id')->index();
			$table->integer('is_active')->default(0);
			$table->string('author');
			$table->string('email');
			$table->text('body');
			$table->timestamps();
			$table->foreign('comment_id')->refrences('id')->on('comments')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments_replies_controllers');
    }
}
