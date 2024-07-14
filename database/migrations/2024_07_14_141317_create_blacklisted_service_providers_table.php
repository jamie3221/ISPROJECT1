<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up(){
    Schema::create('blacklisted_service_providers', function (Blueprint $table){
        $table->id('blacklist_id');
        $table->foreignId('service_provider_id')->constrained('service_providers','service_provider_id')->cascadeOnDelete();
        $table->string('email')->nullable();
        $table->string('phone_number');
        $table->text('reason')->nullable();
        $table->timestamps();
    });
   }
};
