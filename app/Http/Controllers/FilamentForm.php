<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;

class FilamentForm extends Controller
{

    public static function personalDetailForm() {
        return [
           
            Group::make()
            ->relationship('personalDetail')
            ->schema([
                Section::make('PERSONAL DETAILS')

                    ->columns([
                        'sm' => 3,
                        'xl' => 6,
                        '2xl' => 9,
                    ])
                    ->schema([

                        Section::make('')
                            ->columns([
                                'sm' => 3,
                                'xl' => 6,
                                '2xl' => 9,
                            ])
                            ->schema([
                                TextInput::make('first_name')
                                    ->label('FIRST NAME')
                                    ->columnSpan(3)
                                    ->required(),
                                TextInput::make('middle_name')
                                    ->label('FIRST NAME')
                                    ->columnSpan(3)
                                    ->required(),
                                TextInput::make('last_name')
                                    ->label('FIRST NAME')
                                    ->columnSpan(3)
                                    ->required(),
                            ]),
                        Section::make('')
                            ->columns([
                                'sm' => 3,
                                'xl' => 6,
                                '2xl' => 8,
                            ])
                            ->schema([
                                TextInput::make('age')
                                    ->label('AGE')
                                    ->numeric()
                                    ->mask(999)

                                    ->columnSpan(1)
                                    ->required(),
                                TextInput::make('civil_status')
                                    ->label('CIVIL STATUS')
                                    ->columnSpan(2)
                                    ->required(),
                                DatePicker::make('birth_date')
                                    ->label('BIRTH DATE')
                                    ->columnSpan(2)
                                    ->required(),
                                TextInput::make('birth_place')
                                    ->label('BIRTH PLACE')
                                    ->columnSpan(3)
                                    ->required(),
                            ]),

                        FileUpload::make('image')
                            ->disk('public')
                            ->directory('persondetails')
                            ->image()
                            ->imageEditor()
                            // ->required()
                            ->columnSpanFull()
                            ->label('IMAGE ')


                    ]),
            ]),
            ];
    }
}
