<?php

declare(strict_types=1);

namespace App\Modules\Student;

use InvalidArgumentException;
use Illuminate\Support\Facades\Validator;


class StudentValidator
{
    private array $validations = [
        'name' => 'required|string',
        'email' => 'required|email',
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
