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
        Schema::create('raw_materials', function (Blueprint $table) {
            $table->id();
            $table->string('no');
            $table->string('inventoryNo');
            $table->string('status');
            $table->string('minimumQuantity');
            $table->string('repurchaseQuantity');
            $table->string('checkingStatus');
            $table->string('factory');
            $table->unsignedInteger('availablePercentage')->nullable();
            $table->unsignedInteger('quantity'); 
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
        Schema::dropIfExists('raw_materials');
    }
};
