<?php

namespace App\Livewire\Facility;

use App\Models\User;
use Livewire\Component;
use App\Models\Facility;
use Filament\Tables\Table;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\CreateAction;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class UserManagement extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public $facility_id;

    public function table(Table $table): Table
    {
        return $table
        ->query(User::query()->where('role_id', 3)->where('facility_id', auth()->user()->facilities->first()->id))
        ->columns([
            TextColumn::make('name')
            ->searchable(),
            TextColumn::make('email')
            ->searchable(),
            TextColumn::make('facility.name')
            ->label('Facility')
            ->searchable(),
        ])
        ->headerActions([
            CreateAction::make()
                ->model(User::class)
                ->label('Add User')
                ->modalHeading('Add Users')
                ->form([
                    TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    TextInput::make('email')
                    ->unique(ignoreRecord: true)
                    ->required()
                    ->email()
                    ->maxLength(255),
                    TextInput::make('password')
                    ->password()
                    ->revealable()
                    ->confirmed()
                    ->required()
                    ->maxLength(255),
                    TextInput::make('password_confirmation')
                        ->label('Confirm Password')
                        ->password()
                        ->revealable()
                        ->required()
                        ->maxLength(255),
                ])
                ->mutateFormDataUsing(function (array $data): array {
                    $this->facility_id = auth()->user()->facilities->first()->id;
                    unset($data['password_confirmation']);
                    $data['password'] = Hash::make($data['password']);
                    $data['facility_id'] = $this->facility_id;
                    $data['role_id'] = 3;
                    return $data;
                })
                ->disableCreateAnother()
        ])
        ->actions([
            EditAction::make()
            ->form([
                TextInput::make('name')
                ->required()
                ->maxLength(255),
                TextInput::make('email')
                ->required()
                ->email()
                ->maxLength(255),
            ])->button()
        ]);
    }

    public function render()
    {
        return view('livewire.facility.user-management');
    }
}
