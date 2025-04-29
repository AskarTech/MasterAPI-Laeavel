<?php

declare(strict_types=1);

namespace App\Modules\StudentsCoursesEnrollments;

use InvalidArgumentException;
use Illuminate\Support\Facades\DB;


class StudentsCoursesEnrollmentRepository
{

    private $tableName = "students_courses_enrollments";
    private $selectColumns = [
        "students_courses_enrollments.id",
        "students_courses_enrollments.student_id AS studentId",
        "students_courses_enrollments.course_id AS courseId",
        "students_courses_enrollments.enrolled_by_user_id AS enrolledByUserId",
        "students_courses_enrollments.deleted_at AS deletedAt",
        "students_courses_enrollments.created_at AS createdAt",
        "students_courses_enrollments.updated_at AS updatedAt"
    ];

    public function get(int $id): StudentsCoursesEnrollment
    {
        $selectColumns = implode(", ", $this->selectColumns);

        $query = "SELECT {$selectColumns} 
                  FROM {$this->tableName} 
                  WHERE id=:id AND deleted_at IS NULL";

        $result = json_decode(json_encode(DB::selectOne($query, ['id' => $id])), true);
        if ($result) {
            return StudentsCoursesEnrollmentMapper::mapFrom($result);
        }

        throw new InvalidArgumentException("Invalid students courses enrollments id.");
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
                return StudentsCoursesEnrollmentMapper::mapFrom($row)->toArray();
            }, $result);
        }
        throw new \Exception("No students courses enrollments found .");
    }
   
    public function update(StudentsCoursesEnrollment $enrollment): StudentsCoursesEnrollment
    {
        return DB::transaction(function () use ($enrollment) {
            DB::table($this->tableName)->updateOrInsert([
                "id" => $enrollment->getId()
            ], $enrollment->toSQL());
            $id = ($enrollment->getId() === null || $enrollment->getId() === 0)
                ? (int)DB::getPdo()->lastInsertId()
                : $enrollment->getId();

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
            throw new InvalidArgumentException('Invalid students courses enrollments Id.');
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
            throw new InvalidArgumentException('enrollments Id not found or not deleted.');
        }
    
        return true;
    }
    
    public function forceDelete(int $id): bool
    {
        $deleted = DB::table($this->tableName)
            ->where('id', $id)
            ->delete();
    
        if ($deleted === 0) {
            throw new InvalidArgumentException('enrollments not found .');
        }
    
        return true;
    }
    
}
