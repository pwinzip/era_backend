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
        Schema::create('personal_assessments', function (Blueprint $table) {
            $table->unsignedBigInteger('ass_id');
            $table->foreign('ass_id')->references('ass_id')->on('assessments');
            $table->tinyInteger('age');
            $table->tinyInteger('weight');
            $table->tinyInteger('height');
            $table->tinyInteger('career');
            $table->string('income');
            $table->string('high_education');
            $table->string('marital_status');
            $table->tinyInteger('house_member')->default(1);
            $table->tinyInteger('children')->default(0);
            $table->tinyInteger('year_working')->default(1);
            $table->tinyInteger('period_working')->default(8);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('personal_assessments');
    }
};
