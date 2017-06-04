<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLinksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->unique();
            $table->string('description');
            $table->string('url')->unique();
            $table->string('thumbnail_path')->default('/hslogo.jpg');
            $table->integer('vote_sum')->default(0);
            $table->integer('user_id')->unsigned()->nullable();
            $table->timestamps();

            $table->foreign('user_id')
                ->references('id')
                ->on('users');
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }
}
