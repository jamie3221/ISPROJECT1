<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(){
        Schema::create('comments', function (Blueprint $table){
            $table->id('comment_id');
            $table->foreignId('customer-id')->constrained('customers','customer_id')->onDelete('cascade');
            $table->foreignId('service_id')->constrained('services','service_id')->cascadeOnDelete();
            $table->text('comment_content');
            $table->integer('upvotes')->default(0);
            $table->integer('downvotes')->default(0);
            $table->timestamps();
        });
    }
    public function down(){
        Schema::dropIfExists('comments');
    }
};
