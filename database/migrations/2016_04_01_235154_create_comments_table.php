<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('text');
            $table->integer('vote_sum')->default(0);
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('comment_id')->unsigned()->nullable();
            $table->integer('commentable_id')->unsigned();
            $table->softDeletes();
            $table->string('commentable_type');
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');

            $table->foreign('comment_id')
                ->references('id')
                ->on('comments');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('comments');
    }
}
