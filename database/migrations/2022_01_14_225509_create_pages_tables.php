<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePagesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255)->index();
            $table->string('slug', 255)->unique()->index();
            $table->longText('description')->nullable();
            $table->string('short_description', 255)->nullable();
            $table->string('meta_title', 100)->nullable();
            $table->string('meta_keyword', 255)->nullable();
            $table->string('meta_description', 200)->nullable();
            $table->string('featured_image')->nullable();
            $table->string('template', 50);
            $table->enum('status', array('published', 'draft'))->default('draft');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pages');
    }
}
