<?php

declare(strict_types=1);

namespace App\Modules\Student;

use App\Modules\Common\MyHelpers;

class StudentMapper
{
    public static function mapFrom(array $data) : Student
    {
        return new Student(
            MyHelpers::nullStringToInt($data["id"]?? null),
            $data["name"],
            $data["email"],
            $data["deleted_at"] ?? null,
            $data["created_at"] ?? date("Y-m-d H:i:s"),
            $data["updated_at"] ?? null,
           
        );
    }
}