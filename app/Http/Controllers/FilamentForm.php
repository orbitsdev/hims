<?php

namespace App\Http\Controllers;

use App\Models\User;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Semester;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Rawilk\FilamentPasswordInput\Password;
use Filament\Forms\Components\DateTimePicker;

class FilamentForm extends Controller
{


    public static function editProfileForm()
    {
        return [
            Section::make('ACCOUNT DETAILS ')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 12,
                ])
                ->schema([
                    TextInput::make('name')->required()->label('NAME')
                        ->columnSpanFull(),


                    TextInput::make('username')->required()
                        ->unique(ignoreRecord: true)->label('USERNAME')
                        ->columnSpan(4),
                    TextInput::make('email')->required()->label('EMAIL')
                        ->unique(ignoreRecord: true)
                        ->columnSpan(4),


                    // Select::make('role')
                    //     ->default(User::STUDENT)
                    //     ->required()
                    //     ->label('ROLE')
                    //     ->options(User::ROLES)
                    //     ->columnSpan(3)
                    //     ->searchable()
                    //     ->live()
                    //     ->hidden(fn (string $operation): bool => $operation === 'edit'),

                    Password::make('password')
                        ->columnSpan(4)
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->required(fn (string $operation): bool => $operation === 'create')
                        ->label(fn (string $operation) => $operation == 'create' ? 'PASSWORD' : 'NEW PASSWORD'),

                    FileUpload::make('profile_photo_path')
                        ->disk('public')
                        ->directory('accounts')
                        ->image()
                        ->imageEditor()
                        // ->required()
                        ->columnSpanFull()
                        ->label('PROFILE'),


                ])->columnSpanFull(),
           
        ];
    }
    public static function userForm()
    {
        return [
            Section::make('ACCOUNT DETAILS ')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 12,
                ])
                ->schema([
                    TextInput::make('name')->required()->label('NAME')
                        ->columnSpanFull(),


                    TextInput::make('username')->required()
                        ->unique(ignoreRecord: true)->label('USERNAME')
                        ->columnSpan(3),
                    TextInput::make('email')->required()->label('EMAIL')
                        ->unique(ignoreRecord: true)
                        ->columnSpan(3),


                    Select::make('role')
                        ->default(User::STUDENT)
                        ->required()
                        ->label('ROLE')
                        ->options(User::ROLES)
                        ->columnSpan(3)
                        ->searchable()
                        ->live()
                        ->hidden(fn (string $operation): bool => $operation === 'edit'),

                    Password::make('password')
                        ->columnSpan(3)
                        ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                        ->dehydrated(fn (?string $state): bool => filled($state))
                        ->required(fn (string $operation): bool => $operation === 'create')
                        ->label(fn (string $operation) => $operation == 'create' ? 'PASSWORD' : 'NEW PASSWORD'),

                    FileUpload::make('profile_photo_path')
                        ->disk('public')
                        ->directory('accounts')
                        ->image()
                        ->imageEditor()
                        // ->required()
                        ->columnSpanFull()
                        ->label('PROFILE'),


                ])->columnSpanFull(),
            ...FilamentForm::personalDetailForm()
        ];
    }
    public static function personalDetailForm()
    {
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
                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()']),
                                    TextInput::make('middle_name')
                                        ->label('FIRST NAME')
                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()'])

                                        ->columnSpan(3),
                                    TextInput::make('last_name')
                                        ->label('FIRST NAME')
                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()'])

                                        ->columnSpan(3),

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
                                        ->default(18)
                                        ->mask(999)

                                        ->columnSpan(1),

                                    TextInput::make('civil_status')
                                        ->label('CIVIL STATUS')
                                        ->default('SINGLE')
                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()'])

                                        ->columnSpan(2),
                                    DatePicker::make('birth_date')
                                        ->native(false)
                                        ->label('BIRTH DATE')
                                        ->columnSpan(2),
                                    TextInput::make('birth_place')
                                        ->label('BIRTH PLACE')
                                        ->columnSpan(3),
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

    public static function studentForm(): array
    {
        return [
            Section::make('UNIVERSITY DETAILS ')
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
                            Select::make('user_id')
                                ->required()
                                ->label('ACCOUNT')
                                ->options(User::notRegisteredStudents()->pluck('name', 'id'))->searchable()

                                ->columnSpan(3)
                                ->searchable(),
                            //TextInput::make('unique_id')
                            // ->required()
                            //     //     ->maxLength(191),
                            TextInput::make('id_number')->label('ID NUMBER')
                                ->required()

                                ->unique(ignoreRecord: true)
                                ->columnSpan(3),


                            //  TextInput::make('department_id')
                            //     ->required()
                            //     ->label('COLLEGE DEPARTMENT')
                            //     ->columnSpan(3)
                            //     ->numeric(),

                            Select::make('department_id')
                                ->required()
                                ->label('DEPARTMENT')
                                ->options(Department::get()->map(function ($d) {
                                    return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                                })->pluck('name', 'id'))
                                ->searchable()
                                ->columnSpan(3),
                            //TextInput::make('department')
                            // ->required()
                            // ->maxLength(191),


                        ]),
                    FileUpload::make('image')
                        ->disk('public')
                        ->directory('students')
                        ->image()
                        ->imageEditor()
                        // ->required()
                        ->columnSpanFull()
                        ->label('STUDENT IMAGE')
                ]),
        ];
    }

    public static  function notification($message = 'Saved successfully')
    {

        Notification::make()
            ->title($message)
            ->success()
            ->send();
    }

    public static function personnelForm(): array
    {
        return [

            Section::make('')
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
                            '2xl' => 8,
                        ])
                        ->schema([
                            Select::make('user_id')
                                ->required()
                                ->label('ACCOUNT')
                                ->options(User::notRegisteredPersonnel()->get()->map(function ($c) {
                                    return [
                                        'name' => $c->fullName(),
                                        'id' => $c->id
                                    ];
                                })->pluck('name', 'id'))->searchable()

                                ->columnSpan(4)
                                ->searchable(),
                            FileUpload::make('image')
                                ->disk('public')

                                ->directory('personnel')
                                ->image()
                                ->imageEditor()
                                // ->required()
                                ->columnSpan(4)
                                ->label('IMAGE')
                        ]),
                ]),


        ];
    }

    public static function staffForm(): array
    {
        return [


            Section::make('STAFF DETAILS')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 9,
                ])
                ->schema([


                    FileUpload::make('photo')
                        ->disk('public')
                        ->directory('staffs')
                        ->image()
                        ->imageEditor()
                        // ->required()
                        ->columnSpanFull()
                        ->label('PHOTO'),
                    Section::make('')
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 8,
                        ])
                        ->schema([
                            Select::make('user_id')
                                ->live(debounce: 500)
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                    $user = User::findOrFail((int)$state);
                                    if ($user) {

                                        $set('name', $user->fullName());
                                    }
                                    // $set('amount_of_counterpart_fund', null);
                                })
                                ->required()
                                ->label('ACCOUNT')

                                ->options(User::notRegisteredStaff()->get()->map(function ($c) {
                                    return [
                                        'name' => $c->fullName(),
                                        'id' => $c->id
                                    ];
                                })->pluck('name', 'id'))->searchable()

                                ->columnSpan(4)
                                ->searchable(),
                            TextInput::make('name')
                                ->label('NAME')
                                ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()'])

                                ->columnSpan(4)
                                ->maxLength(191),

                        ]),

                    Section::make('EMPLOYMENT & CONTACTS')
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 8,
                        ])
                        ->schema([

                            // TextInput::make('department')
                            //             ->columnSpan(2)
                            //             ->maxLength(191),
                            TextInput::make('phone')
                                ->label('PHONE')
                                ->mask(99999999999)
                                ->columnSpan(2)

                                ->tel()
                                ->maxLength(191),
                            TextInput::make('employment_type')
                                ->label('EMPLOYMENT TYPE')
                                ->default('OJT')
                                ->columnSpan(2)

                                ->maxLength(191),
                            TextInput::make('emergency_contact')
                                ->label('EMERGENCY CONTACT')

                                ->columnSpan(2)

                                ->maxLength(191),

                            TextInput::make('position')
                                ->label('POSITION')
                                ->default('Assistant')
                                ->columnSpan(2)
                                ->maxLength(191),
                            Textarea::make('address')
                                ->label('ADDRESS')
                                ->columnSpanFull(),
                            Textarea::make('notes')
                                ->label('NOTES')
                                ->columnSpanFull(),
                        ]),


                ]),



            // DatePicker::make('started_at'),
            // DatePicker::make('end_at'),
            // Toggle::make('status'),
            // Textarea::make('photo')
            //     ->columnSpanFull(),
        ];
    }

    public static function eventForm(): array
    {
        return [
            Group::make()
            ->schema([
                Section::make('EVENTS DETAILS')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 8,
                ])
                ->schema([
                    Select::make('academic_year_id')
                        ->live(debounce: 500)
                        ->afterStateUpdated(function ($state, Get $get, Set $set) {

                            $set('semester_id', null);
                        })
                        ->required()
                        ->label('ACADEMIC YEAR')

                        ->options(AcademicYear::pluck('name', 'id'))
                        ->preload()
                        ->columnSpan(4)
                        ->searchable(),

                    Select::make('semester_id')->options(function (Get $get) {
                        if (!empty($get('academic_year_id'))) {
                            return Semester::where('academic_year_id', $get('academic_year_id'))->get()->map(function ($a) {
                                return [
                                    'name_in_number' => $a->semesterWithYear(),
                                    'id' => $a->id,
                                ];
                            })->pluck('name_in_number', 'id');
                        } else {
                            return [];
                        }
                    })
                        ->native(false)
                        ->label('SEMESTER')
                        ->columnSpan(4)

                        ->searchable(),
                    Textarea::make('title')
                        ->columnSpanFull(),
                    Textarea::make('content')
                        ->columnSpanFull(),
                    Textarea::make('description')
                        ->columnSpanFull(),
                   

                ]),
                
            ])->columnSpan(['lg' => 2]),
            Group::make()
            ->schema([

                Section::make('')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 8,
                ])
                ->schema([
                    FileUpload::make('image')
                    ->disk('public')
                    ->directory('events')
                    ->image()
                    ->imageEditor()
                    // ->required()
                    ->columnSpanFull()
                    ->label('FEATURED IMAGE'),
                    DateTimePicker::make('event_date')->native(false)->columnSpan(4),
                    DatePicker::make('event_date_time')->columnSpan(4),
              
                    Toggle::make('is_published')
                    ->live()
                    ->columnSpanFull()->afterStateUpdated(function ($record, $state) {
                        FilamentForm::notification($state ?'Status set to Active' : 'Status set to in active');
                    }),
                ]),

               
            ])->columnSpan(['lg' => 1]),
           


        ];
    }
}
