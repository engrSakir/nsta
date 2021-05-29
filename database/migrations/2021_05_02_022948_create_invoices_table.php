<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();

            $table->string('barcode')->nullable()->comment('barcode');
            $table->string('status')->default('Received')->comment('Received|On Going|Delivered|Break');

            $table->foreignId('chalan_id')->nullable()->comment('Chalan Paper ID');
            $table->foreignId('creator_id')->nullable()->comment('Admin/manager who create invoice');
            $table->foreignId('updater_id')->nullable()->comment('Admin/manager who update invoice');
            $table->foreignId('receiver_id')->comment('Customer/Receiver');
            $table->foreignId('from_branch_id');
            $table->foreignId('to_branch_id');

            $table->string('sender_name')->nullable()->comment('Sender name');
            $table->longText('description')->nullable()->comment('Product note');
            $table->string('quantity')->default('0');
            $table->double('price')->default(0)->comment('Main price');
            $table->double('home')->default(0)->comment('Home delivery charge');
            $table->double('labour')->default(0)->comment('Labour charge');
            $table->double('paid')->default(0)->comment('Paid amount');

            $table->double('condition_amount')->default(0)->comment('Only for condition type inv');
            $table->double('condition_charge')->default(0)->comment('Only for condition type inv');

            $table->integer('custom_counter')->nullable()->comment('Custom ID like 1-999');

            $table->string('creator_ip')->nullable()->comment('Creator IP address');
            $table->string('creator_browser')->nullable()->comment('Creator browser');
            $table->string('creator_device')->nullable()->comment('Creator device');
            $table->string('creator_os')->nullable()->comment('Creator os');
            $table->string('creator_location')->nullable()->comment('Creator location');

            $table->string('last_visitor_ip')->nullable()->comment('Last visitor IP address');
            $table->string('last_visitor_browser')->nullable()->comment('Last visitor browser');
            $table->string('last_visitor_device')->nullable()->comment('Last visitor device');
            $table->string('last_visitor_os')->nullable()->comment('Last visitor os');
            $table->string('last_visitor_location')->nullable()->comment('Last visitor location');
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
        Schema::dropIfExists('invoices');
    }
}
