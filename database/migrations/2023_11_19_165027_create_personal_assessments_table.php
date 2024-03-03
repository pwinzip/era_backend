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
            $table->unsignedBigInteger('ass_id')->primary();
            $table->foreign('ass_id')->references('ass_id')->on('assessments');
            $table->tinyInteger('gender');
            $table->tinyInteger('age');
            $table->double('weight');
            $table->double('height');
            $table->text('career'); // follow survey form
            $table->double('income');
            $table->tinyInteger('high_education'); // follow survey form
            $table->tinyInteger('marital_status'); // follow survey form
            $table->tinyInteger('house_member')->default(1);
            $table->tinyInteger('children')->default(0);
            $table->integer('year_working')->default(1);
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
