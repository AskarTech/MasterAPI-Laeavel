<?php

declare(strict_types=1);

namespace App\Modules\Student;

class Student
{

    public function __construct(
       private ?int $id,
       private string $name,
       private string $email,
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
            "name" => $this->name,
            "email" => $this->email,
            "deletedAt" => $this->deletedAt,
            "createdAt" => $this->createdAt,
            "updatedAt" => $this->updatedAt,
        ];
    }
    

    public function toSQL(): array {
        return [
            "id" => $this->id,
            "name" => $this->name,
            "email" => $this->email,
            "deleted_at" => $this->deletedAt,
            "created_at" => $this->createdAt,
            "updated_at" => $this->updatedAt,
        ];
    }

    
    public function getName(): string
    {
        return $this->name;
    }


    public function getId(): ?int
    {
        return $this->id;
    }


    public function getEmail(): string
    {
        return $this->email;
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