<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up() {
        if (!Schema::hasTable('results')) {
            Schema::create('results', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('student_id');
                $table->unsignedBigInteger('franchise_id');
                $table->unsignedBigInteger('course_id');
                $table->unsignedBigInteger('subcourse_id');
                $table->string('result');
                $table->year('passing_year');
                $table->string('semester');
                $table->timestamps();

                // Foreign keys (optional)
                $table->foreign('student_id')->references('id')->on('students')->onDelete('cascade');
                $table->foreign('franchise_id')->references('id')->on('franchises')->onDelete('cascade');
                $table->foreign('course_id')->references('id')->on('courses')->onDelete('cascade');
                $table->foreign('subcourse_id')->references('id')->on('subcourses')->onDelete('cascade');
            });
        }

        if (!Schema::hasTable('result_subjects')) {
            Schema::create('result_subjects', function (Blueprint $table) {
                $table->id();
                $table->unsignedBigInteger('result_id');
                $table->string('subject_code');
                $table->string('subject_name');
                $table->integer('full_marks');
                $table->integer('pass_marks');
                $table->integer('marks_obtained');
                $table->string('grade');
                $table->timestamps();

                $table->foreign('result_id')->references('id')->on('results')->onDelete('cascade');
            });
        }
    }

    public function down() {
        Schema::dropIfExists('result_subjects');
        Schema::dropIfExists('results');
    }
};
