<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('locations', function(Blueprint $table){
            $table->id('location_id');
            $table->string('location_name');
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('locations');
    }
};
