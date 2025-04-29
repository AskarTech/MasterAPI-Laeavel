<?php

declare(strict_types=1);

namespace App\Modules\StudentsCoursesEnrollments;

use App\Modules\Common\MyHelpers;

class StudentsCoursesEnrollmentMapper
{
    public static function mapFrom(array $data) : StudentsCoursesEnrollment
    {
        // dd($data);
        return new StudentsCoursesEnrollment(
            MyHelpers::nullStringToInt($data["id"]?? null),
            $data["studentId"],
            $data["courseId"],
            $data["enrolledByUserId"],
            $data["deleted_at"] ?? null,
            $data["created_at"] ?? date("Y-m-d H:i:s"),
            $data["updated_at"] ?? null,
        );
    }
}