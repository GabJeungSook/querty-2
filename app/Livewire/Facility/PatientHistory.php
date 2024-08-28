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
use Filament\Forms\Form;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;
use Filament\Forms\Components\DatePicker;

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
            ->label('Add Initial Diagnosis')
            ->requiresConfirmation()
            ->icon('heroicon-o-plus-circle')
            ->form([
                Select::make('cases_category_id')
                ->label('Case Categories')
                ->required()
                ->options(CaseCategory::all()->pluck('name', 'id')),
                Textarea::make('initial_diagnosis')
                ->required()
                ->maxLength(255),
            ])
            ->action(function (array $data) {

                DB::beginTransaction();
                Diagnosis::create([
                    'patient_id' => $this->record->patient->id,
                    'initial_diagnosis' => $data['initial_diagnosis'],
                ]);

                historyModel::create([
                    'patient_id' => $this->record->patient->id,
                    'facility_id' => auth()->user()->facilities->first()->id,
                    'case_category_id' => $data['cases_category_id'],
                    'initial_diagnosis' => $data['initial_diagnosis'],
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

    public function editAdmissionAction(): Action
    {
        return Action::make('editAdmission')
        ->label('Edit Diagnosis')
        ->requiresConfirmation()
        ->icon('heroicon-o-plus-circle')
        ->mountUsing(function (Form $form) {
            $diagnosis = Diagnosis::where('patient_id', $this->record->patient->id)->first();
            $form->fill([
                'cases_category_id' => $this->record->patient->case_category_id,
                'initial_diagnosis' => $diagnosis->initial_diagnosis,
            ]);
        })
        ->form([
            Select::make('cases_category_id')
            ->label('Case Categories')
            ->required()
            ->options(CaseCategory::all()->pluck('name', 'id')),
            Textarea::make('initial_diagnosis')
            ->required()
            ->maxLength(255),
        ])
        ->action(function (array $data) {
            DB::beginTransaction();
            $diagnosis = Diagnosis::where('patient_id', $this->record->patient->id)->first();
            $diagnosis->initial_diagnosis = $data['initial_diagnosis'];
            $diagnosis->save();

            $this->record->patient->case_category_id = $data['cases_category_id'];
            $this->record->patient->save();

            $history = historyModel::where('patient_id', $this->record->patient->id)->first();
            $history->case_category_id = $data['cases_category_id'];
            $history->initial_diagnosis = $data['initial_diagnosis'];
            $history->save();
            DB::commit();

            Notification::make()
                ->title('Updated successfully')
                ->success()
                ->send();
        });
    }

    public function dischargeAction(): Action
    {
        return Action::make('discharge')
        ->label('Discharge Patient')
        ->requiresConfirmation()
        ->color('danger')
        ->icon('heroicon-o-x-circle')
        ->form([
            DatePicker::make('date_of_diagnosis')
            ->native(false)
            ->default(now()),
            Textarea::make('final_diagnosis')
            ->required()
            ->maxLength(255),
        ])
        ->action(function (array $data) {
            DB::beginTransaction();
            $diagnosis = Diagnosis::where('patient_id', $this->record->patient->id)->first();
            $diagnosis->final_diagnosis = $data['final_diagnosis'];
            $diagnosis->date_of_diagnosis = $data['date_of_diagnosis'];
            $diagnosis->save();

            $history = historyModel::where('patient_id', $this->record->patient->id)->first();
            $history->final_diagnosis = $data['final_diagnosis'];
            $history->date_of_diagnosis = $data['date_of_diagnosis'];
            $history->save();
            DB::commit();

            Notification::make()
                ->title('Saved successfully')
                ->success()
                ->send();
        });
    }

    public function render()
    {
        return view('livewire.facility.patient-history');
    }
}
