<?php

declare(strict_types=1);

namespace App\Modules\StudentsCoursesEnrollments;

use InvalidArgumentException;
use Illuminate\Support\Facades\Validator;

 
class StudentsCoursesEnrollmentValidator
{
    private StudentsCoursesEnrollmentDatabaseValidator $dbValidator;
    private array $validations = [
        "studentId" => "required|int|exists:students,id",
            "courseId" => "required|int|exists:courses,id",
            "enrolledByUserId" => "required|int|exists:users,id",
    ];
    
    public function __construct(StudentsCoursesEnrollmentDatabaseValidator $dbValidator)
    {
        $this->dbValidator = $dbValidator;
    }


    public function validate(array $data): void
    {
        // Perform validation logic here
        $validator = Validator::make($data, $this->validations);

        if ($validator->fails()) {
            throw new InvalidArgumentException(json_encode($validator->errors()->all()));
        }

        $this->dbValidator->validate($data["courseId"], $data["studentId"]);
    }
}
