<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('service_provider_reports', function (Blueprint $table){
            $table->id('report_id');
            $table->foreignId('service_provider_id')->constrained('service_providers','service_provider_id')->cascadeOnDelete();
            $table->foreignId('service_id')->constrained('services','service_id')->cascadeOnDelete();
            $table->text('report_content');
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('service_provider_reports');
    }
};
