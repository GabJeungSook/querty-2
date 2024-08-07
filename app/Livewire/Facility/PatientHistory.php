<?php

namespace App\Livewire\Facility;

use Livewire\Component;
use App\Models\PatientInformation;

class PatientHistory extends Component
{
    public $record;

    public function mount($record)
    {
        $this->record = PatientInformation::find($record);
    }

    public function render()
    {
        return view('livewire.facility.patient-history');
    }
}
