<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('title', 255);
            $table->text('description');
            $table->unsignedBigInteger('create_by_id');
            $table->unsignedBigInteger('updated_by_id')->nullable();
            $table->timestamps();
            
            $table->foreign('create_by_id')->references('id')->on('users');
            $table->foreign('updated_by_id')->references('id')->on('users');
        });
    }

   
    public function down()
    {
        Schema::dropIfExists('data');
    }
}
