<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCardTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Card attributes
        Schema::create('classes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->text('description')->nullable();
            $table->timestamps();
        });

        Schema::create('card_languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('lang_id');
            $table->string('name')->nullable();
            $table->timestamps();
        });

        // Many to Many
        Schema::create('card_mechanics', function ( Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        /*
        Schema::create('card_costs', function ( Blueprint $table){
            $table->increments('id');
            $table->integer('cost');
            $table->string('for')->nullable();
            $table->string('description')->nullable();
            $table->timestamps();
        });
        */

        Schema::create('card_play_reqs', function ( Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Card has one
        Schema::create('card_rarities', function ( Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('card_sets', function ( Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        Schema::create('card_types', function ( Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('description')->nullable();
            $table->timestamps();
        });

        // Card 
        Schema::create('cards', function ( Blueprint $table){
            $table->increments('id');
            $table->string('card_id')->unique();
            $table->string('collectable')->nullable();
            $table->string('texture');
            $table->integer('cost')->nullable();
            $table->integer('hp')->nullable();
            $table->integer('atk')->nullable();
            $table->string('image_path')->nullable();
            $table->integer('class_id')->unsigned()->nullable();
            $table->integer('card_rarity_id')->unsigned();
            $table->integer('card_type_id')->unsigned();
            $table->integer('card_set_id')->unsigned();
            $table->timestamps();

            $table->foreign('card_rarity_id')
                ->references('id')
                ->on('card_rarities');

            $table->foreign('card_type_id')
                ->references('id')
                ->on('card_types');

            $table->foreign('card_set_id')
                ->references('id')
                ->on('card_sets');

            $table->foreign('class_id')
                ->references('id')
                ->on('classes');
        });

        // Card has Many
        Schema::create('card_texts', function (Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->string('text')->nullable();
            $table->integer('card_id')->unsigned();
            $table->integer('card_language_id')->unsigned();
            $table->timestamps();

            $table->foreign('card_language_id')
                ->references('id')
                ->on('card_languages');

            $table->foreign('card_id')
                ->references('id')
                ->on('cards');
        });

        // Pivots
        Schema::create('card_card_mechanic', function ( Blueprint $table){
            $table->integer('card_mechanic_id')->unsigned();
            $table->integer('card_id')->unsigned();

            $table->foreign('card_mechanic_id')
                ->references('id')
                ->on('card_mechanics');

            $table->foreign('card_id')
                ->references('id')
                ->on('cards');

            $table->primary(['card_mechanic_id', 'card_id']);
        });

        Schema::create('card_card_play_req', function ( Blueprint $table){
            $table->integer('card_play_req_id')->unsigned();
            $table->integer('card_id')->unsigned();
            $table->integer('value');

            $table->foreign('card_play_req_id')
                ->references('id')
                ->on('card_play_reqs');

            $table->foreign('card_id')
                ->references('id')
                ->on('cards');

            $table->primary(['card_play_req_id', 'card_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('card_card_play_req');
        Schema::drop('card_card_mechanic');
        Schema::drop('card_texts');
        Schema::drop('cards');
        Schema::drop('card_types');
        Schema::drop('card_sets');
        Schema::drop('card_rarities');
        Schema::drop('card_play_reqs');
        Schema::drop('card_mechanics');
        Schema::drop('card_languages');
        Schema::drop('classes');
    }
}
