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
        Schema::create('user_attempts_dtl', function (Blueprint $table) {
            $table->id('attempt_id');
            $table->String('userSelect_Ans');
            $table->String('correct_ans');
            $table->unsignedBigInteger('user_id_fk');
            $table->foreign('user_id_fk')->references('user_id')->on('user_details')
                ->OnDelete('cascade')->OnUpdate('cascade');
            $table->unsignedBigInteger('userRecord_id_fk');
            $table->foreign('userRecord_id_fk')->references('userRecord_id')->on('user_records_details')
                ->OnDelete('cascade')->OnUpdate('cascade');
            $table->unsignedBigInteger('mcq_id_fk');
            $table->foreign('mcq_id_fk')->references('mcq_id')->on('mcq')
                ->OnDelete('cascade')->OnUpdate('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_attempts_dtl');
    }
};
