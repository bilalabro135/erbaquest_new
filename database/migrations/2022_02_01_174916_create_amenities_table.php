<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAmenitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('amenities', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('icon', 255);
            $table->timestamps();
            $table->softDeletes();
        });
        Schema::create('event_amenities', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('amenity_id')->unsigned()->nullable();
            $table->foreign('amenity_id')->references('id')->on('amenities')->onDelete('cascade');
            $table->bigInteger('event_id')->unsigned()->nullable();
            $table->foreign('event_id')->references('id')->on('events')->onDelete('cascade');
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
        Schema::dropIfExists('amenities');
        Schema::dropIfExists('event_amenities');
    }
}
