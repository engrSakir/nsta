<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessageHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('message_histories', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('branch_id')->nullable();
            $table->foreignId('sender_id')->comment('message sender user id')->nullable();
            $table->foreignId('receiver_id')->nullable();
            $table->string('number');
            $table->longText('message');
            $table->integer('text_count')->default(0);
            $table->integer('message_count')->default(0);
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
        Schema::dropIfExists('message_histories');
    }
}
