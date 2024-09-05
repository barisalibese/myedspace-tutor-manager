<?php

namespace App\Livewire;

use App\Filament\Resources\TutorResource;
use App\Services\TutorService;
use Livewire\Component;

class TutorSearch extends Component
{
    public ?string $searchText = null;

    public array $subjects = [];

    public array $subjectOptions = TutorResource::SUBJECTS;

    public float $hourlyRate = 0;

    private TutorService $tutorService;

    public array $result = [];

    public float $maxHourlyRate = 0;

    public function __construct()
    {
        $this->tutorService = new TutorService;
        $this->maxHourlyRate = $this->tutorService->getMinAndMaxRates();

    }

    public function render(array $result = []): \Illuminate\Contracts\View\View|\Illuminate\Contracts\View\Factory|\Illuminate\Foundation\Application
    {
        return view('livewire.tutor-search');
    }

    public function updated()
    {
        // This method will be called anytime a public property is updated
        $this->search(); // Call your search method here
    }

    public function search()
    {
        $data = [
            'hourlyRate' => $this->hourlyRate,
            'searchText' => $this->searchText,
            'subjects' => $this->subjects,
        ];

        $this->result = $this->tutorService->searchTutors(
            $data
        )->toArray();
    }
}
