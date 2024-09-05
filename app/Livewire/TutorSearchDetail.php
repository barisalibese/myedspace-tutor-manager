<?php

namespace App\Livewire;

use Livewire\Component;

class TutorSearchDetail extends Component
{
    public array $item = [];

    public function render()
    {
        return view('livewire.tutor-search-detail');
    }
}
