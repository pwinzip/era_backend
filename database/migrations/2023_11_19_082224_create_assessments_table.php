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
            $table->foreign('elder_id')->references('id')->on('elders');
            $table->unsignedBigInteger('assessor_id');
            $table->foreign('assessor_id')->references('id')->on('users');
            $table->tinyInteger('month');
            $table->integer('year');
            $table->boolean('ass_personal')->default(false);
            $table->boolean('ass_part1')->default(false);
            $table->boolean('ass_part2')->default(false);
            $table->boolean('ass_part3')->default(false);
            $table->boolean('ass_part4')->default(false);
            $table->boolean('ass_part5')->default(false);
            $table->boolean('ass_part6')->default(false);
            $table->boolean('ass_part7')->default(false);
            $table->boolean('ass_part8')->default(false);
            $table->tinyInteger('status')->default(0); // 0 not submit, 1 submit 
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
