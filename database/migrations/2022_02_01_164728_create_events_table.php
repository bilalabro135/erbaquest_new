<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->string('slug',  255)->unique();
            $table->longText('featured_image')->nullable();
            $table->longText('description')->nullable();
            $table->longText('gallery')->nullable();
            $table->date('event_date');
            $table->longText('address')->nullable();
            $table->longText('type')->nullable();
            $table->decimal('door_dontation')->nullable();
            $table->decimal('vip_dontation')->nullable();
            $table->decimal('vip_perk')->nullable();
            $table->decimal('charity')->nullable();
            $table->decimal('cost_of_vendor')->nullable();
            $table->integer('vendor_space_available')->nullable();
            $table->string('area', 100)->nullable();
            $table->integer('height')->nullable();
            $table->string('capacity', 255)->nullable();
            $table->string('ATM_on_site', 255)->nullable();
            $table->string('tickiting_number', 255)->nullable();
            $table->string('vendor_number', 255)->nullable();
            $table->string('user_number', 255)->nullable();
            $table->string('website_link', 255)->nullable();
            $table->string('facebook', 255)->nullable();
            $table->string('twitter', 255)->nullable();
            $table->string('linkedin', 255)->nullable();
            $table->string('instagram', 255)->nullable();
            $table->string('youtube', 255)->nullable();
            $table->enum('status', array('published', 'draft'))->default('draft');
            $table->bigInteger('user_id')->unsigned()->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('events');
    }
}
