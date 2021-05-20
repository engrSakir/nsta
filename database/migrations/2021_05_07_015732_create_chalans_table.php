<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChalansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chalans', function (Blueprint $table) {
            $table->id();
            $table->foreignId('from_branch_id');
            $table->foreignId('to_branch_id');
            $table->foreignId('created_by');
            $table->integer('custom_counter')->nullable()->comment('Custom ID like 1-999');
            $table->string('driver_name')->nullable();
            $table->string('driver_phone')->nullable();
            $table->string('car_number')->nullable();
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
        Schema::dropIfExists('chalans');
    }
}
