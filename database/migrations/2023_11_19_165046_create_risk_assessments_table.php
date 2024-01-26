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
        Schema::create('risk_assessments', function (Blueprint $table) {
            $table->id('risk_ass_id');
            $table->unsignedBigInteger('ass_id');
            $table->foreign('ass_id')->references('ass_id')->on('assessments');
            $table->tinyInteger('part');
            $table->string('subpart');
            $table->tinyInteger('touch');
            $table->tinyInteger('violent');
            $table->string('manage');
            $table->string('note')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('risk_assessments');
    }
};
