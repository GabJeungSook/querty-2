<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Facility;
use Filament\Tables\Table;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class Facilities extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
        ->query(Facility::query())
        ->columns([
            TextColumn::make('name')
            ->searchable(),
            TextColumn::make('address')
            ->searchable(),
        ])
        ->headerActions([
            CreateAction::make()
                ->model(Facility::class)
                ->label('Add Facility')
                ->modalHeading('Add Facility')
                ->form(FilamentForm::facilityForm())->disableCreateAnother()
        ])
        ->actions([
            EditAction::make()
            ->form(FilamentForm::facilityForm())->button()
        ]);
    }

    public function render()
    {
        return view('livewire.admin.facilities');
    }
}
