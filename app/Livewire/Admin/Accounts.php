<?php

namespace App\Livewire\Admin;

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

class Accounts extends Component implements HasForms, HasTable
{
    use InteractsWithTable;
    use InteractsWithForms;
    public $facility_id;
    public function table(Table $table): Table
    {
        return $table
        ->query(User::query()->whereNot('id', 1))
        ->columns([
            TextColumn::make('name')
            ->searchable(),
            TextColumn::make('email')
            ->searchable(),
            TextColumn::make('facilities.name')
            ->label('Facility')
            ->searchable(),
        ])
        ->headerActions([
            CreateAction::make()
                ->model(User::class)
                ->label('Add Account')
                ->modalHeading('Add Account')
                ->form([
                    Select::make('facility_id')
                    ->label('Facility')
                    ->options(Facility::whereDoesntHave('user')->pluck('name', 'id'))
                    ->searchable(),
                    TextInput::make('name')
                    ->required()
                    ->maxLength(255),
                    TextInput::make('email')
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
                    $this->facility_id = $data['facility_id'];
                    unset($data['password_confirmation']);
                    unset($data['facility_id']);
                    $data['password'] = Hash::make($data['password']);
                    $data['role_id'] = 2;
                    return $data;
                })
                ->after(function (array $data) {
                    $facility = Facility::find($this->facility_id);
                    $user = User::latest()->first();
                    $facility->user_id = $user->id;
                    $facility->save();
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
        return view('livewire.admin.accounts');
    }
}
