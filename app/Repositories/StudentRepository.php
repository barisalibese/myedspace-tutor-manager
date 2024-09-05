<?php

namespace App\Repositories;

use App\Models\Student;
use Illuminate\Database\Eloquent\Model;

class StudentRepository extends BaseRepository
{
    public function getTotalRegisteredStudents(): int
    {
        return $this->model->count();
    }

    protected function setModel(): Model
    {
        return new Student;
    }
}
