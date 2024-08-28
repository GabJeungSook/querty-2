<?php

namespace App\Livewire\Facility;

use Livewire\Component;
use App\Models\CaseCategory as CasesModel;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Concerns\InteractsWithTable;

class Cases extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;

    public function table(Table $table): Table
    {
        return $table
        ->query(CasesModel::query())
        ->columns([
            TextColumn::make('name')
            ->searchable(),
        ])
        ->headerActions([
            CreateAction::make()
                ->model(CasesModel::class)
                ->label('Add Case Category')
                ->modalHeading('Add Case Category')
                ->form([
                    TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                ])->visible(fn ($record) => auth()->user()->role->name === 'admin')
                ->disableCreateAnother()
        ])
        ->actions([
            EditAction::make()
                ->label('Edit')
                ->modalHeading('Edit Case Category')
                ->button()
                ->form([
                    TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                ])->visible(fn ($record) => auth()->user()->role->name === 'admin')
        ]);
    }

    public function render()
    {
        return view('livewire.facility.cases');
    }
}
