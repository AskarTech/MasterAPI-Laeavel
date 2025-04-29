<?php

declare(strict_types=1);

namespace App\Modules\Courses;

use App\Modules\Courses\CourseRepository;
use App\Modules\Courses\CourseValidator;

class CourseService
{
    private CourseValidator $validator;
    private CourseRepository $repository;
    public function __construct(CourseValidator $validator, CourseRepository $repository)
    {
        $this->validator = $validator;
        $this->repository = $repository;
    }

    public function get(int $id): Course
    {
        return $this->repository->get($id);
    }
    public function getAll(): array
    {
        $data = $this->repository->getAll();
        return $data;
    }
    public function update(array $data) : Course
    {
        $this->validator->validate($data);
        return $this->repository->update(
            CourseMapper::mapFrom($data)
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
