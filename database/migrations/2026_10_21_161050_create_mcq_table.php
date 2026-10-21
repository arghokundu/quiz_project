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
        Schema::create('mcq', function (Blueprint $table) {
            $table->id('mcq_id');
            $table->string('Question_Name')->unique();
            $table->string('optionA');
            $table->string('optionB');
            $table->string('optionC');
            $table->string('optionD');
            $table->string('correct_Answer');
            $table->smallInteger('quiz_id_fk');
            $table->foreign('quiz_id_fk')->references('quiz_id')->on('quizs')
                ->OnDelete('cascade')->OnUpdate('cascade');
            $table->smallInteger('cat_id_fk');
            $table->foreign('cat_id_fk')->references('cat_id')->on('category')
                ->OnDelete('cascade')->OnUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mcq');
    }
};
