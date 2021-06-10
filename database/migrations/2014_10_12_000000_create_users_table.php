<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('type')->comment('Super Admin|Admin|Manager|Customer')->default('Customer');
            $table->string('image')->nullable();
            $table->string('name');
            $table->string('email')->nullable();//unique
            $table->string('phone')->nullable();//unique
            $table->string('username')->nullable();//unique
            $table->timestamp('email_verified_at')->nullable();
            $table->string('password');
            $table->boolean('is_active')->default(1);
            $table->foreignId('company_id')->nullable()->comment('For admin and manager');
            $table->foreignId('branch_id')->nullable()->comment('only for manager');
            $table->foreignId('creator_id')->nullable()->comment('Who add this user');
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
