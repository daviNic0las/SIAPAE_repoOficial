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
        Schema::create('med_histories', function (Blueprint $table) {
            $table->id();
            // I - Identificacion
            $table->string('informant');
            $table->date('date_of_anamnesis');
            $table->unsignedBigInteger('student_id');
            $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
            $table->string('appraisal');
            $table->boolean('have_caregiver');
            $table->boolean('do_AEE');
            $table->string('class_AEE')->nullable();
            $table->string('study')->nullable();
            $table->text('name_mother');
            $table->date('date_mother');
            $table->string('rg_mother');
            $table->string('profession_mother');
            $table->text('name_father');
            $table->date('date_father');
            $table->string('rg_father');
            $table->string('profession_father');
            $table->string('address');
            $table->string('cellphone');
            $table->boolean('have_medication');
            $table->string('what_medication')->nullable();
            // II - Initial complaint
            $table->string('compplaint')->nullable();
            // III - Socio-family situation
            $table->string('who_lives');
            $table->string('state_parents_relation');
            $table->string('time_state_relation')->nullable();
            $table->boolean('new_relation_mother');
            $table->string('time_new_relation_mother')->nullable();
            $table->string('lives_new_relation_mother')->nullable();
            $table->boolean('new_relation_father');
            $table->string('time_new_relation_father')->nullable();
            $table->string('lives_new_relation_father')->nullable();
            $table->boolean('have_kinship_parents');
            $table->text('what_kinship_parents')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('med_histories');
    }
};
