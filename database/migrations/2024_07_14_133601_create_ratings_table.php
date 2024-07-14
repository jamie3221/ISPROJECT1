<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB; 
return new class extends Migration
{
    public function up(){
        Schema::create('ratings', function (Blueprint $table){
            $table->id('rating_id');
            $table->foreignId('service_id')->constrained('services','service_id')->cascadeOnDelete();
            $table->foreignId('customer_id')->constrained('customers','customer_id')->cascadeOnDelete();
            $table->tinyInteger('rating');
            $table->timestamps();
        });
        DB::statement('ALTER TABLE ratings ADD CONSTRAINT chk_rating CHECK (rating >= 1 AND rating <= 5)');
    }
    public function down(){
        Schema::dropIfExists('ratings');
    }
};
