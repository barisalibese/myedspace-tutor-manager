<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;
use App\Livewire\TutorSearch;
use App\Models\Tutor;
use Livewire\Livewire;
use Tests\TestCase;

class TutorSearchTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function test_tutor_search_success(): void
    {
        $tutor = Tutor::find(1);
        Livewire::test(TutorSearch::class)->set('searchText', $tutor->name)->assertSee($tutor->name);
    }

    public function test_tutor_search_with_subject_filter_success(): void
    {
        $tutor = Tutor::find(1);
        Livewire::withQueryParams(['subjects' => $tutor->subjects])->test(TutorSearch::class)
            ->call('search')
            ->assertSee($tutor->name)
            ->assertSee($tutor->id)
            ->assertSee($tutor->subjects);
    }

    public function test_tutor_search_with_price_filter_success(): void
    {
        $tutor = Tutor::find(1);
        Livewire::withQueryParams(['subjects' => $tutor->subjects])->test(TutorSearch::class)
            ->call('search')
            ->assertSee($tutor->name)
            ->assertSee($tutor->id)
            ->assertSee($tutor->subjects);
    }
}
