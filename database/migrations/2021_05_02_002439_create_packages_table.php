<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePackagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('packages', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_active')->default(true);
            $table->string('name');
            $table->integer('branch')->default(1)->comment('max-permitted');
            $table->integer('admin')->default(1)->comment('max-permitted');
            $table->integer('manager')->default(1)->comment('max-permitted');
            $table->integer('customer')->default(50)->comment('max-permitted');
            $table->integer('invoice')->default(100)->comment('max-permitted');
            $table->integer('free_sms')->default(100)->comment('free-message');
            $table->float('price_per_message')->default(0.47)->comment('Price of sms');
            $table->integer('duration')->default(10)->comment('in-day');
            $table->integer('price')->default(500)->comment('price of package');
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
        Schema::dropIfExists('packages');
    }
}
