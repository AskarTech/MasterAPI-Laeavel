<?php

declare(strict_types=1);

namespace App\Modules\Courses;

use App\Modules\Common\MyHelpers;

class CourseMapper
{
    public static function mapFrom(array $data) :Course
    {
        return new Course(
            MyHelpers::nullStringToInt($data["id"]?? null),
            $data["name"],
            $data["total_students_enrolled"] ?? 0,
            $data["capacity"] ,
            $data["deleted_at"] ?? null,
            $data["created_at"] ?? date("Y-m-d H:i:s"),
            $data["updated_at"] ?? null,
        );
    }
}