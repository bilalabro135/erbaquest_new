<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tickets', function (Blueprint $table) {
            $table->id();
            $table->integer('total')->nullable();
            $table->string('price')->nullable();
            $table->integer('qty')->nullable();
            $table->string('discount_code')->nullable();
            $table->string('discount_percentage')->nullable();
            $table->integer('max_utilization')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date')->nullable();
            $table->string('vip_ticket')->nullable();
            $table->integer('total_vip')->nullable();
            $table->string('vip_ticket_price')->nullable();
            $table->integer('user_qty')->nullable();
            $table->enum('status', array('published', 'draft'))->default('draft');
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
        Schema::dropIfExists('tickets');
    }
}
