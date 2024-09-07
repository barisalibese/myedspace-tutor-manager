<?php

namespace Tests\Feature;

use App\Models\Tutor;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Tests\TestCase;

class TutorResourceListActionsTest extends TestCase
{
    use DatabaseTransactions;

    public function test_can_bulk_update_tutor_hourly_rates()
    {
        $tutors = Tutor::factory()->count(5)->create(['hourly_rate' => 50]);

        // Run the Livewire component for the bulk action
        Livewire::test('App\Filament\Resources\TutorResource\Pages\ListTutors')
            ->callTableBulkAction('updateHourlyRates', $tutors, [
                'percentage' => 10,
                'type' => 'increase',
            ])
            ->assertSuccessful();


    }

    public function test_can_edit_action_success()
    {
        $tutor = Tutor::factory()->create();

        // Run the Livewire component for the bulk action
        Livewire::test('App\Filament\Resources\TutorResource\Pages\ListTutors')
            ->callTableAction('edit', $tutor,['name'=>'test test'])
            ->assertSuccessful();

    }

    public function test_can_delete_action_success()
    {
        $tutors = Tutor::factory()->count(5)->create(['hourly_rate' => 50]);

        Livewire::test('App\Filament\Resources\TutorResource\Pages\ListTutors')
            ->callTableBulkAction('delete', $tutors)
            ->assertSuccessful();

    }
}
