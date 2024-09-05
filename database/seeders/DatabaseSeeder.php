<?php

namespace Database\Seeders;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Collection;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    private Collection $tutors;

    private Collection $students;

    public function run(): void
    {
        $this->createUserForAdmin();
        $this->createTutors();
        $this->createStudents();
        $this->attachStudentToTutors();
    }

    private function createUserForAdmin(): void
    {
        User::factory()->create([
            'name' => 'ADMIN',
            'email' => env('ADMIN_EMAIL'),
            'password' => env('ADMIN_PASSWORD'),
        ]);
    }

    private function createTutors(): void
    {
        $this->tutors = Tutor::factory(100)->create();
    }

    private function createStudents(): void
    {
        $this->students = Student::factory(10000)->create();
    }

    private function attachStudentToTutors(): void
    {
        $this->tutors->each(function ($tutor) {
            $tutor->students()->attach(
                $this->students->random(rand(1, 10))->pluck('id')->toArray()
            );
        });
    }
}
