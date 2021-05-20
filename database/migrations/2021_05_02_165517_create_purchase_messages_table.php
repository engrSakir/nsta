<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePurchaseMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_messages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('company_id');
            $table->foreignId('purchaser_id');
            $table->integer('message_amount');
            $table->integer('price_per_message');
            $table->foreignId('package_id');
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
        Schema::dropIfExists('purchase_messages');
    }
}
