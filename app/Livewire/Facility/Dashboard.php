<?php

namespace App\Livewire\Facility;

use Livewire\Component;

class Dashboard extends Component
{
    public $selectedMonth;
    public $date_from;
    public $date_to;

    public function mount()
    {
        $this->selectedMonth = now()->format('F');
        $this->date_from = now()->startOfMonth()->format('Y-m-d');
        $this->date_to = now()->endOfMonth()->format('Y-m-d');
    }

    public function render()
    {
        return view('livewire.facility.dashboard');
    }
}
