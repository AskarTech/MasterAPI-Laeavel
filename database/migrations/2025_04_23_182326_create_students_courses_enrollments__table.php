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
        Schema::create('students_courses_enrollments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("student_id");
            $table->unsignedBigInteger("course_id");
            $table->unsignedBigInteger("enrolled_by_user_id");
            $table->softDeletes();
            $table->timestamps();
            $table->foreign("student_id")->references("id")->on("students");
            $table->foreign("course_id")->references("id")->on("courses");
            $table->foreign("enrolled_by_user_id")->references("id")->on("users");
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('students_courses_enrollments_');
    }
};
