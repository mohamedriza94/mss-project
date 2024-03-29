<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
    * Run the migrations.
    *
    * @return void
    */
    public function up()
    {
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->string('requestNo')->unique();
            $table->string('date');
            $table->string('time');
            $table->string('status');
            $table->string('inventoryNo');
            $table->string('rawMaterial');
            $table->string('factory');
            $table->string('quantity');
            $table->timestamps();
        });
    }
    
    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists('requests');
    }
};
