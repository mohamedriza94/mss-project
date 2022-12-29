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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('taskNo')->unique();
            $table->string('name');
            $table->string('cardNo');
            $table->string('description')->nullable();
            $table->string('startDate');
            $table->string('endDate');
            $table->unsignedInteger('duration')->nullable();
            $table->string('date');
            $table->string('time');
            $table->string('status');
            $table->string('factory');
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
        Schema::dropIfExists('tasks');
    }
};
