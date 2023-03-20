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
        Schema::create('question_enquete', function (Blueprint $table) {
            $table->id();
            $table->foreignId('question_id')->references('id')->on('questions');
            $table->foreignId('enquete_id')->references('id')->on('enquetes');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('question_enquete');
    }
};
