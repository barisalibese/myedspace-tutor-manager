<?php

namespace Tests\Unit;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\TutorStudent;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class StudentTest extends TestCase
{
    use DatabaseTransactions;

    private array $testData = [
        'name' => 'Mert Barış Alibeşe',
        'email' => 'barisalibese@gmail.com',
        'grade_level' => 5,
    ];

    public function test_student_created_success(): void
    {
        $student = Student::factory()->create(
            $this->testData
        );

        $this->assertDatabaseHas('students', ['id' => $student->id]);
    }

    public function test_student_update_success(): void
    {
        $student = Student::factory()->create(
            $this->testData
        );
        $testData = [
            'email' => 'barisalibese2@gmail.com',
            'grade_level' => 5,
        ];
        $student->update($testData);
        $this->assertDatabaseHas('students', ['email' => 'barisalibese2@gmail.com', 'grade_level' => 5]);
    }

    public function test_student_student_relate_success(): void
    {
        $tutor = Tutor::factory()->create();
        $student = Student::factory()->create();
        $student->tutors()->attach($tutor);
        $this->assertTrue($student->tutors()->where('tutor_id', $tutor->id)->exists());
    }

    public function test_student_and_relation_delete_success()
    {
        $tutor = Tutor::factory()->create();
        $student = Student::factory()->create();

        $student->tutors()->attach($tutor);

        TutorStudent::where('tutor_id', $tutor->id)->where('student_id', $student->id)->delete();

        $student->delete();

        $this->assertSoftDeleted($student);

        $this->assertSoftDeleted('tutor_students', [
            'tutor_id' => $tutor->id,
            'student_id' => $student->id,
        ]);
    }
}
