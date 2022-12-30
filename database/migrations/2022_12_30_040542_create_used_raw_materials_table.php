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
        Schema::create('used_raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('task');
            $table->string('card');
            $table->string('factory');
            $table->string('rawMaterial');
            $table->string('workshop');
            $table->string('worker');
            $table->string('quantity');
            $table->string('inventory');
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
        Schema::dropIfExists('used_raw_materials');
    }
};
