<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('customers', function (Blueprint $table){
            $table->id('customer_id');
            $table->string('first_name');
            $table->string('middle_name')->nullable();
            $table->string('last_name');
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('customers');
    }
};
