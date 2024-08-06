<?php

namespace App\Livewire\Admin;

use Livewire\Component;
use App\Models\Facility;
use Filament\Tables\Table;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
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
                ->model(User::class)
                ->label('Add Facility')
                ->modalHeading('Add Facility')
                ->form([
                    TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    Textarea::make('address')
                    ->required()
                    ->maxLength(255),
                ])->disableCreateAnother()
        ]);
    }

    public function render()
    {
        return view('livewire.admin.facilities');
    }
}
