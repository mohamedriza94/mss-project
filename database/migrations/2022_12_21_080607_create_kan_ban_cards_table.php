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
        Schema::create('kan_ban_cards', function (Blueprint $table) {
            $table->id();
            $table->string('cardNo')->unique();
            $table->string('providedBy');
            $table->string('factoryNo');
            $table->string('status');
            $table->string('date');
            $table->string('time');
            $table->string('title')->nullable();
            $table->string('description')->nullable();
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
        Schema::dropIfExists('kan_ban_cards');
    }
};
