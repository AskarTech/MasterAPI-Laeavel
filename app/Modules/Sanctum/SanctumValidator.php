<?php

declare(strict_types=1);

namespace App\Modules\Sanctum;

use InvalidArgumentException;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Illuminate\Http\Exceptions\HttpResponseException;

class SanctumValidator
{
    private array $validations = [
        'email' => 'required|email',
        'password' => 'required|string',
        'device' => 'required|string'
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
