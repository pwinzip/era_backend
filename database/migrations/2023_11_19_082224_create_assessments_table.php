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
        Schema::create('assessments', function (Blueprint $table) {
            $table->id('ass_id');
            $table->unsignedBigInteger('elder_id');
            $table->foreign('elder_id')->references('user_id')->on('elders');
            $table->unsignedBigInteger('volunteer_id');
            $table->foreign('volunteer_id')->references('user_id')->on('volunteers');
            $table->tinyInteger('month');
            $table->tinyInteger('year');
            $table->boolean('ass_personal');
            $table->boolean('ass_part1');
            $table->boolean('ass_part2');
            $table->boolean('ass_part3');
            $table->boolean('ass_part4');
            $table->boolean('ass_part5');
            $table->boolean('ass_part6');
            $table->boolean('ass_part7');
            $table->boolean('ass_part8');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assessments');
    }
};
