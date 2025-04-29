<?php

declare(strict_types=1);

namespace App\Modules\Courses;

use InvalidArgumentException;
use Illuminate\Support\Facades\Validator;


class CourseValidator
{
    private array $validations = [
        'name' => 'required|string',
        'capacity' => 'required|integer',
    ];

    public function __construct()
    {
        // Constructor logic if needed
    }

    public function validate(array $data): void
    {
        // Perform validation logic here
        $validator = Validator::make($data, $this->validations);

        if ($validator->fails()) {
            throw new InvalidArgumentException(json_encode($validator->errors()->all()));
        }

       
    }
}
