<?php

namespace Tests\Feature;

use App\Models\Student;
use App\Models\Tutor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class StudentResourceListActionsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_create_action_success()
    {
        $data = [
            'email' => 'test@test.test',
            'name' => 'test test',
            'grade_level' => 2
        ];

        Livewire::test('App\Filament\Resources\StudentResource\Pages\ListStudents')
            ->callTableAction('create', null, $data)
            ->assertSuccessful();

    }

    public function test_can_edit_action_success()
    {
        $student = Student::factory()->create();

        Livewire::test('App\Filament\Resources\StudentResource\Pages\ListStudents')
            ->callTableAction('edit', $student, ['name' => 'test test'])
            ->assertSuccessful();

    }

    public function test_can_delete_action_success()
    {
        $students = Student::factory()->count(5)->create();

        Livewire::test('App\Filament\Resources\StudentResource\Pages\ListStudents')
            ->callTableBulkAction('delete', $students)
            ->assertSuccessful();

    }
}
