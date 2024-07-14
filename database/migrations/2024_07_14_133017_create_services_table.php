<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('services', function(Blueprint $table){
            $table->id('service_id');
            $table->string('service_name');
            $table->foreignId('service_provider_id')->constrained('service_providers', 'service_provider_id')->onDelete('cascade');
            $table->foreignId('location_id')->constrained('locations','location_id')->onDelete('cascade');
            $table->text('description')->nullable();
            $table->json('pictures')->nullable();
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('servicer');
    }
};
