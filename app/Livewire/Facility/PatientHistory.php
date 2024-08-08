<?php

namespace App\Livewire\Facility;

use Livewire\Component;
use App\Models\Diagnosis;
use App\Models\CaseCategory;
use Filament\Actions\Action;
use App\Models\PatientHistory as historyModel;
use App\Models\PatientInformation;
use Illuminate\Support\Facades\DB;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class PatientHistory extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;

    public $record;

    public function mount($record)
    {
        $this->record = PatientInformation::find($record);
    }

    public function addDiagnosisAction(): Action
    {
        return Action::make('addDiagnosis')
            ->label('Add Diagnosis')
            ->requiresConfirmation()
            ->icon('heroicon-o-plus-circle')
            ->form([
                Select::make('cases_category_id')
                ->label('Case Categories')
                ->required()
                ->options(CaseCategory::all()->pluck('name', 'id')),
                Textarea::make('diagnosis')
                ->required()
                ->maxLength(255),
            ])
            ->action(function (array $data) {

                DB::beginTransaction();
                Diagnosis::create([
                    'patient_id' => $this->record->patient->id,
                    'diagnosis' => $data['diagnosis'],
                ]);

                historyModel::create([
                    'patient_id' => $this->record->patient->id,
                    'facility_id' => auth()->user()->facilities->first()->id,
                    'case_category_id' => $data['cases_category_id'],
                    'diagnosis' => $data['diagnosis'],
                ]);

                $this->record->patient->facility_id = auth()->user()->facilities->first()->id;
                $this->record->patient->case_category_id = $data['cases_category_id'];
                $this->record->patient->save();
                DB::commit();

                Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();

                //refresh the page
            });
    }

    public function render()
    {
        return view('livewire.facility.patient-history');
    }
}
