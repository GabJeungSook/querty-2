<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Textarea;

class FilamentForm extends Controller
{
    public static function facilityForm() :array {
        return [
            TextInput::make('name')
            ->required()
        
            ->maxLength(255),
            Textarea::make('address')
            ->required()
            ->maxLength(255),
        ];
    }
}
