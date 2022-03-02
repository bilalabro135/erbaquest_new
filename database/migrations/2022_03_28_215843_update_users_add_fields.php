<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateUsersAddFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('username', 100)->unique()->after('name');
            $table->string('phone', 255)->nullable()->after('email');
            $table->string('address', 255)->nullable()->after('phone');
            $table->string('profile_image', 255)->nullable()->after('address');
            $table->bigInteger('package_id')->unsigned()->nullable()->after('profile_image');
            $table->foreign('package_id')->references('id')->on('packages')->onDelete('cascade');
            $table->longText('ip_key')->nullable();
            $table->string('stripe_id')->nullable()->index();
            $table->string('pm_type')->nullable();
            $table->string('pm_last_four', 4)->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
