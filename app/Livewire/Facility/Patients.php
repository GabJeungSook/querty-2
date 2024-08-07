<?php

namespace App\Livewire\Facility;

use App\Models\Patient;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\PatientInformation;
use Filament\Tables\Actions\Action;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Patients extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
        ->query(PatientInformation::query())
        ->columns([
            TextColumn::make('philhealth_number')
            ->searchable(),
            TextColumn::make('patient.facility.name')
            ->searchable(),
            TextColumn::make('first_name')
            ->searchable(),
            TextColumn::make('last_name')
            ->searchable(),
            TextColumn::make('address')
            ->searchable(),
        ])
        ->headerActions([
            Action::make('add_patient')
            ->label('Add Patient')
            ->form([
                TextInput::make('philhealth_number')
                ->required()
                ->maxLength(255),
                TextInput::make('first_name')
                ->required()
                ->maxLength(255),
                TextInput::make('last_name')
                ->required()
                ->maxLength(255),
                Textarea::make('address')
                ->required()
                ->maxLength(255),
                DatePicker::make('date_of_birth')
                ->required()
            ])
            ->action(function(array $data) {
                    //if existing philhealth number
                    $existing_patient = PatientInformation::where('philhealth_number', $data['philhealth_number'])->first();
                    if($existing_patient) {
                        Notification::make()
                        ->title('Patient already exists')
                        ->danger()
                        ->send();
                        return;
                    }else{
                        $patient = Patient::create([
                            'facility_id' => auth()->user()->facilities->first()->id,
                        ]);

                        $patient_info = PatientInformation::create([
                            'patient_id' => $patient->id,
                            'philhealth_number' => $data['philhealth_number'],
                            'first_name' => $data['first_name'],
                            'last_name' => $data['last_name'],
                            'address' => $data['address'],
                            'date_of_birth' => $data['date_of_birth'],
                        ]);

                        Notification::make()
                        ->title('Saved successfully')
                        ->success()
                        ->send();
                    }


            }),
        ])
        ->actions([
            Action::make('view')
            ->label('View History')
            ->button()
            ->icon('heroicon-o-eye')
            ->url(fn (PatientInformation $record): string => route('facility.patient-history', $record)),
        ]);
    }

    public function render()
    {
        return view('livewire.facility.patients');
    }
}
