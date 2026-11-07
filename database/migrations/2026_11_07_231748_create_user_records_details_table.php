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
        Schema::create('user_records_details', function (Blueprint $table) {
            $table->id('userRecord_id');
            $table->unsignedBigInteger('quiz_id_fk');
            $table->foreign('quiz_id_fk')->references('quiz_id')->on('quizs')
                ->OnDelete('cascade')->OnUpdate('cascade');
            $table->unsignedBigInteger('user_id_fk');
            $table->foreign('user_id_fk')->references('user_id')->on('user_details')
                ->OnDelete('cascade')->OnUpdate('cascade');
            $table->integer('status');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_records_details');
    }
};
