<?php

declare(strict_types=1);

namespace App\Modules\StudentsCoursesEnrollments;

use InvalidArgumentException;
use App\Modules\Courses\CourseService;
use App\Modules\Student\StudentService;
use Illuminate\Support\Facades\Validator;


class StudentsCoursesEnrollmentDatabaseValidator 
{
    private CourseService $courseService;
    private StudentService $studentService;

    public function __construct(CourseService $courseService, StudentService $studentService)
    {
        $this->courseService = $courseService;
        $this->studentService = $studentService;
    }



    public function validate(int $courseId, int $studentId): void
    {
        $course = $this->courseService->get($courseId);

        if ($course->getTotalStudentsEnrolled() >= $course->getCapacity()) {
            throw new InvalidArgumentException("Failed to enroll student. Course enrollment limit {$course->getTotalStudentsEnrolled()} reached.");
        }

        // no duplicates allowed
        $studentsEnrolled = $this->studentService->getByCourseId($courseId);
        if (collect($studentsEnrolled)->contains(fn($s) => $s->getId() === $studentId)) {
            throw new InvalidArgumentException("Student already enrolled in this course.");
        }
        // for ($i = 0; $i < count($studentsEnrolled); $i++) {
        //     if ($studentsEnrolled[$i]->getId() === $studentId) {
        //         throw new InvalidArgumentException("Failed to enroll student. Student already registered.");
        //     }
        // }
    }
}
