<?php

declare(strict_types=1);

namespace App\Modules\Student;

use InvalidArgumentException;
use Illuminate\Support\Facades\DB;


class StudentRepository
{

    private $tableName = 'students';
    private $selectColumns = [
        "students.id",
        "students.name",
        "students.email",
        "students.deleted_at AS deletedAt",
        "students.created_at AS createdAt",
        "students.updated_at AS updatedAt"
    ];

    public function get(int $id): Student
    {
        $selectColumns = implode(", ", $this->selectColumns);
        $query = "SELECT {$selectColumns} FROM {$this->tableName} WHERE id=:id AND deleted_at IS NULL";
        $result = DB::selectOne($query, ['id' => $id]);
        $data = json_decode(json_encode($result), true);
        // $result = DB::select($query, ['name' => 'ahmed']);
        // $data1 = $result ? (array)$result : null;
        if ($data) {
            return StudentMapper::mapFrom($data);
        }

        throw new \Exception("Student not found");
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
                return StudentMapper::mapFrom($row)->toArray();
            }, $result);
        }
        throw new \Exception("No students found .");
    }
    // public function getAll(): array
    // {
    //     $students = DB::table($this->tableName)
    //         ->whereNull('deleted_at')
    //         ->get($this->selectColumns)
    //         ->toArray(); // تحويل الكائنات إلى مصفوفة

    //     $mappedStudents = [];
    //     foreach ($students as $student) {
    //         $mappedStudents[] = StudentMapper::mapFrom((array)$student);
    //     }

    //     return $mappedStudents;
    // }
    // public function create(Student $student): void
    // {
    //     $data = $student->toSQL();
    //     DB::table($this->tableName)->insert($data);
    // }
    // public function update(Student $student): void
    // {
    //     $data = $student->toSQL();
    //     DB::table($this->tableName)->where('id', $student->getId())->update($data);
    // }

    //or we can create and update by this method:
    public function update(Student $student): Student
    {
        return DB::transaction(function () use ($student) {
            DB::table($this->tableName)->updateOrInsert([
                "id" => $student->getId()
            ], $student->toSQL());
            $id = ($student->getId() === null || $student->getId() === 0)
                ? (int)DB::getPdo()->lastInsertId()
                : $student->getId();

            return $this->get($id);
        });
    }
    //or we can update and insert by this method:
    // public function save(Student $student): Student
    // {
    //     return DB::transaction(function () use ($student) {
    //         $data = $student->toSQL();

    //         if ($student->getId() !== null && DB::table($this->tableName)->where('id', $student->getId())->exists()) {
    //             // الطالب موجود → نحدث السجل
    //             DB::table($this->tableName)
    //                 ->where('id', $student->getId())
    //                 ->update($data);

    //             $id = $student->getId();
    //         } else {
    //             // الطالب غير موجود → نضيف سجل جديد
    //             $id = DB::table($this->tableName)->insertGetId($data);
    //         }

    //         return $this->get($id);
    //     });
    // }


    public function getByCourseId(int $courseId):array
    {
        $selectColumns=implode(",",$this->selectColumns);
        $query = "SELECT $selectColumns FROM $this->tableName JOIN students_courses_enrollments ON students_courses_enrollments.course_id = :courseId
                    WHERE $this->tableName.id= students_courses_enrollments.student_id
                    AND students_courses_enrollments.deleted_at IS NULL";
        $result = json_decode(json_encode(
            DB::select($query, ['courseId' => $courseId])), true

        );
        if (count($result) === 0) {
            return [];
         }
 
         return array_map(function ($row) {
             return StudentMapper::mapFrom($row);
         }, $result);
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
            throw new InvalidArgumentException('Student not found or already deleted.');
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
            throw new InvalidArgumentException('Student not found or not deleted.');
        }
    
        return true;
    }
    
    public function forceDelete(int $id): bool
    {
        $deleted = DB::table($this->tableName)
            ->where('id', $id)
            ->delete();
    
        if ($deleted === 0) {
            throw new InvalidArgumentException('Student not found.');
        }
    
        return true;
    }
    
}
