<?php

namespace App\Services;

use App\Repositories\StudentRepository;

class StudentService
{
    private StudentRepository $repository;

    public function __construct()
    {
        $this->repository = new StudentRepository;
    }

    public function getTotalNumberOfRegisteredStudents(): int
    {
        return $this->repository->getTotalRegisteredStudents();
    }
}
