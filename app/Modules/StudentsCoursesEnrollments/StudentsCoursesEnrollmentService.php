<?php

declare(strict_types=1);

namespace App\Modules\StudentsCoursesEnrollments;

use Illuminate\Support\Facades\Auth;
use App\Modules\Courses\CourseValidator;
use App\Modules\Courses\CourseRepository;

class StudentsCoursesEnrollmentService
{
    private StudentsCoursesEnrollmentValidator $validator;
    private StudentsCoursesEnrollmentRepository $repository;
    public function __construct(StudentsCoursesEnrollmentValidator $validator, StudentsCoursesEnrollmentRepository $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function get(int $id): StudentsCoursesEnrollment
    {
        return $this->repository->get($id);
    }
    public function getAll(): array
    {
        $data = $this->repository->getAll();
        return $data;
    }
    public function update(array $data) : StudentsCoursesEnrollment
    {
        $data = array_merge(
            $data,
            [
                "enrolledByUserId" => Auth::user()->id
            ]
        );
        $this->validator->validate($data);
        return $this->repository->update(
            StudentsCoursesEnrollmentMapper::mapFrom($data)
        );
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
