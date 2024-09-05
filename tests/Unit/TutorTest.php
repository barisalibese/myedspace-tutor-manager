<?php

namespace Tests\Unit;

use App\Models\Student;
use App\Models\Tutor;
use App\Models\TutorStudent;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

class TutorTest extends TestCase
{
    use DatabaseTransactions;

    private array $testData = [
        'avatar' => 'https://fastly.picsum.photos/id/0/5000/3333.jpg?hmac=_j6ghY5fCfSD6tvtcV74zXivkJSPIfR9B8w34XeQmvU',
        'name' => 'Mert Barış Alibeşe',
        'email' => 'barisalibese@gmail.com',
        'subjects' => ['Math', 'Physics'],
        'bio' => 'bla bla bla bla bla bla',
        'hourly_rate' => 20.22,
    ];

    public function test_tutor_created_success(): void
    {
        $tutor = Tutor::factory()->create(
            $this->testData
        );

        $this->assertDatabaseHas('tutors', ['id' => $tutor->id]);
    }

    public function test_tutor_update_success(): void
    {
        $tutor = Tutor::factory()->create(
            $this->testData
        );
        $testData = [
            'email' => 'barisalibese2@gmail.com',
            'hourly_rate' => 22.22,
        ];
        $tutor->update($testData);
        $this->assertDatabaseHas('tutors', ['email' => 'barisalibese2@gmail.com', 'hourly_rate' => 22.22]);
    }

    public function test_tutor_student_relate_success(): void
    {
        $tutor = Tutor::factory()->create();
        $student = Student::factory()->create();
        $tutor->students()->attach($student);
        $this->assertTrue($tutor->students()->where('student_id', $student->id)->exists());
    }

    public function test_tutor_and_relation_delete_success()
    {
        $tutor = Tutor::factory()->create();
        $student = Student::factory()->create();

        $tutor->students()->attach($student->id);

        TutorStudent::where('student_id', $student->id)->where('tutor_id', $tutor->id)->delete();

        $tutor->delete();

        $this->assertSoftDeleted($tutor);

        $this->assertSoftDeleted('tutor_students', [
            'tutor_id' => $tutor->id,
            'student_id' => $student->id,
        ]);
    }
}
