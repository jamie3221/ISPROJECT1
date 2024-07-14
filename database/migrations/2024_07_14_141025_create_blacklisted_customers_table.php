<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(){
    Schema::create('blacklisted_customers', function (Blueprint $table){
        $table->id('blacklist_id');
        $table->foreignId('customer_id')->constrained('customers','customer_id')->cascadeOnDelete();
        $table->string('email')->nullable();
        $table->string('phone_number')->unique();
        $table->text('reason')->nullable();
        $table->timestamps();
    });
   }
   public function down(){
    Schema::dropIfExists('blacklisted_customers');
}
};
