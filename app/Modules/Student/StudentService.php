<?php

declare(strict_types=1);

namespace App\Modules\Student;

use App\Modules\Student\StudentRepository;
use App\Modules\Student\StudentValidator;

class StudentService
{
    private StudentValidator $validator;
    private StudentRepository $repository;
    public function __construct(StudentValidator $validator, StudentRepository $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function get(int $id): Student
    {
        return $this->repository->get($id);
    }
    public function getAll(): array
    {
        $data = $this->repository->getAll();

        return $data ;
    }
    public function update(array $data) : Student
    {
        $this->validator->validate($data);
        return $this->repository->update(
            StudentMapper::mapFrom($data)
        );
    }
    public function getByCourseId(int $courseId) : array
    {
        return $this->repository->getByCourseId($courseId);
    }
    public function softDelete(int $id): bool
{
    return $this->repository->softDelete($id);
}

public function restore(int $id): bool
{
    return $this->repository->restore($id);
}

public function forceDelete(int $id): bool
{
    return $this->repository->forceDelete($id);
}

}
