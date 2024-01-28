<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('elders', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->primary();
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('house_no');
            $table->tinyInteger('moo');
            $table->string('tambon');
            $table->string('amphoe');
            $table->unsignedBigInteger('volunteer_id');
            $table->foreign('volunteer_id')->references('user_id')->on('volunteers');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('elders');
    }
};
