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
        Schema::create('frequencies', function (Blueprint $table) {
            $table->id();
            $table->string('student_name');
            $table->string('class_apae');
            $table->string('turn_apae');
            $table->string('month_year');
            $table->string('observation')->nullable();
            for ($i = 1; $i <= 31; $i++) { 
                $table->boolean((string)$i)->nullable(); 
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frequencies');
    }
};
