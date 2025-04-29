<?php

declare(strict_types=1);

namespace App\Modules\StudentsCoursesEnrollments;

class StudentsCoursesEnrollment
{

    public function __construct(
       private ?int $id,
       private int $studentId,
       private int $courseId,
       private int $enrolledByUserId,
       private ?string $deletedAt,
       private string $createdAt,
       private ?string $updatedAt,
    )
    {
        // Constructor logic can be added here if needed
    }

    public function toArray(): array {
        return [
            "id" => $this->id,
            "studentId"=>$this->studentId,
            "courseId"=>$this->courseId,
            "enrolledByUserId"=>$this->enrolledByUserId,
            "deletedAt" => $this->deletedAt,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt,
        ];
    }
    

    public function toSQL(): array {
        return [
            "id" => $this->id,
            "student_id"=>$this->studentId,
            "course_id"=>$this->courseId,
            "enrolled_by_user_id"=>$this->enrolledByUserId,
            "deleted_at" => $this->deletedAt,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
        ];
    }

    
   

    public function getId(): ?int
    {
        return $this->id;
    }
    public function getStudentsId(): int
    {
        return $this->studentId;
    }
    public function getCoursesId(): int
    {
        return $this->courseId;
    }
    public function getEnrolledByUsersId(): int
    {
        return $this->enrolledByUserId;
    }
    public function getDeletedAt(): ?string
    {
        return $this->deletedAt;
    }
    public function getCreatedAt(): string
    {
        return $this->createdAt;
    }
    public function getUpdatedAt(): ?string
    {
        return $this->updatedAt;
    }


}