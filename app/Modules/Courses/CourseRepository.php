<?php

declare(strict_types=1);

namespace App\Modules\Courses;

use InvalidArgumentException;
use Illuminate\Support\Facades\DB;


class CourseRepository
{

    private $tableName = 'courses';
    private $selectColumns = [
        "courses.id",
        "courses.name",
        "courses.capacity",
        "(
            SELECT COUNT(*)
            FROM students_courses_enrollments
            WHERE students_courses_enrollments.courses_id = courses.id
            AND students_courses_enrollments.deleted_at IS NULL
        ) AS total_students_enrolled",
        "courses.deleted_at AS deletedAt",
        "courses.created_at AS createdAt",
        "courses.updated_at AS updatedAt"
    ];

    public function get(int $id): Course
    {
        $selectColumns = implode(", ", $this->selectColumns);

        $query = "SELECT {$selectColumns} 
                  FROM {$this->tableName} 
                  WHERE id=:id AND deleted_at IS NULL";

        $result = json_decode(json_encode(DB::selectOne($query, ['id' => $id])), true);
       
        if ($result) {
            return CourseMapper::mapFrom($result);
        }

        throw new \Exception("Course not found");
    }
    public function getAll(): array
    {
        $selectColumns=implode(",",$this->selectColumns);
        $query = "SELECT $selectColumns FROM $this->tableName 
                    WHERE deleted_at IS NULL";
        $result = json_decode(json_encode(
            DB::select($query)), true

        );
        if ($result) {
            return array_map(function ($row) {
                return CourseMapper::mapFrom($row)->toArray();
            }, $result);
        }
        throw new \Exception("No Courses found .");
    }
   
    public function update(Course $Course): Course
    {
        return DB::transaction(function () use ($Course) {
            DB::table($this->tableName)->updateOrInsert([
                "id" => $Course->getId()
            ], $Course->toSQL());
            $id = ($Course->getId() === null || $Course->getId() === 0)
                ? (int)DB::getPdo()->lastInsertId()
                : $Course->getId();

            return $this->get($id);
        });
    }
   

    public function softDelete(int $id): bool
    {
        $updated = DB::table($this->tableName)
            ->where('id', $id)
            ->whereNull('deleted_at')
            ->update([
                'deleted_at' => now()
            ]);
    
        if ($updated === 0) {
            throw new InvalidArgumentException('Course not found or already deleted.');
        }
    
        return true;
    }
    
    public function restore(int $id): bool
    {
        $restored = DB::table($this->tableName)
            ->where('id', $id)
            ->whereNotNull('deleted_at')
            ->update([
                'deleted_at' => null
            ]);
    
        if ($restored === 0) {
            throw new InvalidArgumentException('Course not found or not deleted.');
        }
    
        return true;
    }
    
    public function forceDelete(int $id): bool
    {
        $deleted = DB::table($this->tableName)
            ->where('id', $id)
            ->delete();
    
        if ($deleted === 0) {
            throw new InvalidArgumentException('Course not found.');
        }
    
        return true;
    }
    
}
