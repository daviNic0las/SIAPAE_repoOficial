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
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('class');
            $table->string('shift');
            $table->string('month');
            $table->integer('year');
            $table->string('observation');
            $table->string('signature');
            $table->boolean('1')->nullable();
            $table->boolean('2')->nullable();
            $table->boolean('3')->nullable();
            $table->boolean('4')->nullable();
            $table->boolean('5')->nullable();
            $table->boolean('6')->nullable();
            $table->boolean('7')->nullable();
            $table->boolean('8')->nullable();
            $table->boolean('9')->nullable();
            $table->boolean('10')->nullable();
            $table->boolean('11')->nullable();
            $table->boolean('12')->nullable();
            $table->boolean('13')->nullable();
            $table->boolean('15')->nullable();
            $table->boolean('16')->nullable();
            $table->boolean('17')->nullable();
            $table->boolean('18')->nullable();
            $table->boolean('19')->nullable();
            $table->boolean('20')->nullable();
            $table->boolean('21')->nullable();
            $table->boolean('22')->nullable();
            $table->boolean('23')->nullable();
            $table->boolean('24')->nullable();
            $table->boolean('25')->nullable();
            $table->boolean('26')->nullable();
            $table->boolean('27')->nullable();
            $table->boolean('28')->nullable();
            $table->boolean('29')->nullable();
            $table->boolean('30')->nullable();
            $table->boolean('31')->nullable();
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
