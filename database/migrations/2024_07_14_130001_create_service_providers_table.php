<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 
return new class extends Migration
{
    public function up(){
        Schema::create('service_providers', function (Blueprint $table){
            $table->id('service_provider_id');
            $table->enum('service_provider_type', ['individual','business']);
            $table->string('first_name')->nullable();
            $table->string('middle_name')->nullable();
            $table->string('last_name')->nullable();
            $table->string('business_name')->nullable();
            $table->string('email')->unique();
            $table->string('phone_number')->unique();
            $table->string('password');
            $table->string('profile_picture')->nullable();
            $table->timestamps();
        });
        DB::statement('ALTER TABLE service_providers ADD CONSTRAINT chk_service_provider CHECK (
            (service_provider_type = "individual" AND first_name IS NOT NULL AND last_name IS NOT NULL AND business_name IS NULL) OR
            (service_provider_type = "business" AND business_name IS NOT NULL AND first_name IS NULL AND last_name IS NULL)
        )');
    }
    public function down(){
        Schema::dropIfExists('service_providers');
    }
};
