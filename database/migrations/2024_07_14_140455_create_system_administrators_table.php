<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('system_administrators', function (Blueprint $table) {
            $table->id('admin_id');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('admin_name');
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('system_administrators');
    }
};
