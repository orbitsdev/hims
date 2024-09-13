<?php

namespace App\Http\Controllers;

use Closure;
use App\Models\User;
use App\Models\Course;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Semester;
use App\Models\Condition;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\Section as MSection;
use Filament\Forms\Components\Tabs;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Wizard;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\TextColumn;
use Illuminate\Validation\Rules\Unique;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Rawilk\FilamentPasswordInput\Password;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\Actions\Action;
use Filament\Forms\Components\DateTimePicker;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;


class FilamentForm extends Controller
{
    const CIVIL_STATUS_OPTIONS = [
        'Single' => 'Single',
        'Married' => 'Married',
        'Widowed' => 'Widowed',
        'Separated' => 'Separated',
        'Divorced' => 'Divorced',
        'Annulled' => 'Annulled',
        'reviewing' => 'Reviewing',
        'published' => 'Published',
    ];



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
                        ->columnSpan(4),


                    TextInput::make('username')->required()
                        ->unique(ignoreRecord: true)->label('USERNAME')
                        ->columnSpan(4),
                    TextInput::make('email')->required()->label('EMAIL')
                        ->unique(ignoreRecord: true)
                        ->disabled()
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

                    // Password::make('password')
                    //     ->columnSpan(4)
                    //     ->dehydrateStateUsing(fn (string $state): string => Hash::make($state))
                    //     ->dehydrated(fn (?string $state): bool => filled($state))
                    //     ->required(fn (string $operation): bool => $operation === 'create')
                    //     ->label(fn (string $operation) => $operation == 'create' ? 'PASSWORD' : 'NEW PASSWORD'),

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
                        ->hidden(fn(string $operation): bool => $operation === 'edit'),

                    Password::make('password')
                        ->columnSpan(3)
                        ->dehydrateStateUsing(fn(string $state): string => Hash::make($state))
                        ->dehydrated(fn(?string $state): bool => filled($state))
                        ->required(fn(string $operation): bool => $operation === 'create')
                        ->label(fn(string $operation) => $operation == 'create' ? 'PASSWORD' : 'NEW PASSWORD'),

                    FileUpload::make('profile_photo_path')
                        ->disk('public')
                        ->directory('accounts')
                        ->image()
                        ->imageEditor()
                        // ->required()
                        ->columnSpanFull()
                        ->label('PROFILE'),


                ])->columnSpanFull(),
            // ...FilamentForm::personalDetailForm()
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
                                        ->required()
                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()']),
                                    TextInput::make('middle_name')
                                        ->label('MIDDLE NAME')
                                        ->required()

                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()'])

                                        ->columnSpan(3),
                                    TextInput::make('last_name')
                                        ->label('LAST NAME')
                                        ->required()

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
                                        ->required()

                                        ->default(18)
                                        ->mask(999)

                                        ->columnSpan(1),

                                    Select::make('civil_status')
                                        ->label('CIVIL STATUS')
                                        ->options(FilamentForm::CIVIL_STATUS_OPTIONS)
                                        ->default('Single')
                                        ->columnSpan(4)
                                        ->searchable(),

                                    DatePicker::make('birth_date')
                                        ->native(false)
                                        ->required()
                                        ->label('BIRTH DATE')
                                        ->columnSpan(3),
                                    TextInput::make('birth_place')
                                        ->label('BIRTH PLACE')
                                        ->label('BIRTH_PLACE')
                                        ->columnSpan(4),
                                    TextInput::make('address')
                                        ->label('ADDRESS')
                                        ->required()
                                        ->columnSpan(4),
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


            Wizard::make([
                Wizard\Step::make('UNIVERSITY DETAILS ')
                    ->schema([
                        Section::make()
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
                                        ->options(User::notRegisteredStudents()->pluck('name', 'id'))->searchable()
        
                                        ->columnSpan(4)
                                        ->searchable(),
                                    //TextInput::make('unique_id')
                                    // ->required()
                                    //     //     ->maxLength(191),
                                    TextInput::make('id_number')->label('ID NUMBER')
                                        ->required()
        
                                        ->unique(ignoreRecord: true)
                                        ->columnSpan(4),
        
        
                                    //  TextInput::make('department_id')
                                    //     ->required()
                                    //     ->label('COLLEGE DEPARTMENT')
                                    //     ->columnSpan(3)
                                    //     ->numeric(),
        
        
                                    //TextInput::make('department')
                                    // ->required()
                                    // ->maxLength(191),
        
        
                                ]),
                            Section::make('')
                                ->columns([
                                    'sm' => 3,
                                    'xl' => 6,
                                    '2xl' => 9,
                                ])
                                ->schema([
        
                                    Select::make('department_id')
                                        ->required()
                                        ->label('BUILDING/DEPARTMENT')
                                        ->options(Department::studentDepartment()->get()->map(function ($d) {
                                            return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                                        })->pluck('name', 'id'))
                                        ->live(debounce: 500)
                                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
        
        
                                            $set('course_id', null);
        
                                            $set('section_id', null);
                                        })
                                        ->searchable()
                                        ->columnSpan(3)
                                        ->createOptionForm(FilamentForm::departmentForm()),
        
        
        
                                    Select::make('course_id')
                                        ->live(debounce: 500)
                                        ->afterStateUpdated(function ($state, Get $get, Set $set) {
        
                                            $set('section_id', null);
                                        })
                                        ->required()
                                        ->label('COURSE')
        
                                        ->options(function (Get $get) {
                                            if (!empty($get('department_id'))) {
                                                return Course::where('department_id', $get('department_id'))->get()->map(function ($a) {
                                                    return [
                                                        'name' => $a->getNameWithAbbreviation(),
                                                        'id' => $a->id,
                                                    ];
                                                })->pluck('name', 'id');
                                            } else {
                                                return [];
                                            }
                                        })
                                        ->preload()
                                        ->columnSpan(3)
                                        ->searchable(),
        
        
                                    Select::make('section_id')->options(function (Get $get) {
                                        if (!empty($get('course_id'))) {
                                            return MSection::where('course_id', $get('course_id'))->get()->map(function ($a) {
                                                return [
                                                    'name' => $a->name,
                                                    'id' => $a->id,
                                                ];
                                            })->pluck('name', 'id');
                                        } else {
                                            return [];
                                        }
                                    })
                                        ->required()
                                        ->preload()
                                        ->searchable()
                                        ->native(false)
                                        ->label('SECTION')
                                        ->columnSpan(3)
                                        ->hidden(function (Get $get) {
        
                                            if ($get('department_id') != null) {
                                                $department = Department::findOrFail($get('department_id'));
                                                return $department->role != User::STUDENT;
                                            }
                                            return false;
                                        }),
        
        
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
                    ]),
                Wizard\Step::make('Personal Details')
                    ->schema([
                        ...FilamentForm::personalDetailForm()
                    ]),
              
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
            Wizard::make([
                Wizard\Step::make('Account Details')
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
                            Select::make('department_id')
                                ->required()
                                ->label('BUILDING/DEPARTMENT')
                                ->options(Department::personnelDepartment()->get()->map(function ($d) {
                                    return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                                })->pluck('name', 'id'))
                                ->searchable()
                                ->columnSpan(4)
                                ->createOptionForm(FilamentForm::departmentForm()),
                            FileUpload::make('image')
                                ->disk('public')

                                ->directory('personnel')
                                ->image()
                                ->imageEditor()
                                // ->required()
                                ->columnSpanFull()
                                ->label('IMAGE')
                        ]),
           
                    ]),
                Wizard\Step::make('Personal Details')
                    ->schema([
                        ...FilamentForm::personalDetailForm()
                    ]),
               
                ]),

           

        ];
    }

    public static function staffForm(): array
    {
        return [
            Wizard::make([
                Wizard\Step::make('STAFF DETAILS')
                    ->schema([
                        Section::make('')
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
                                    '2xl' => 6,
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
        
                                        ->columnSpan(2)
                                        ->searchable(),
        
                                    TextInput::make('name')
                                        ->label('NAME')
                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()'])
        
                                        ->columnSpan(2)
                                        ->maxLength(191),
        
                                    Select::make('department_id')
                                        ->required()
                                        ->label('BUILDING/DEPARTMENT')
                                        ->options(Department::staffDepartment()->get()->map(function ($d) {
                                            return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                                        })->pluck('name', 'id'))
                                        ->searchable()
                                        ->columnSpan(2)
                                        ->createOptionForm(FilamentForm::departmentForm()),
        
        
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
                    ]),
                Wizard\Step::make('Personal Details')
                    ->schema([
                        ...FilamentForm::personalDetailForm()
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

            Tabs::make('Events')
    ->tabs([
        Tabs\Tab::make('EVENTS DETAILS')
        ->icon('heroicon-o-calendar-days')
            ->schema([
                Section::make('')
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
                            Textarea::make('description')
                                ->columnSpanFull(),

                            RichEditor::make('content')->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                                ->columnSpanFull(),

                            // Textarea::make('content')
                            //     ->columnSpanFull(),


                        ]),
            ]),
        Tabs\Tab::make('Settings')
        ->icon('heroicon-o-cog-6-tooth')
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
                    DatePicker::make('event_date')->native(false)->columnSpanFull()->date()->required(),
                    // DatePicker::make('event_date_time')->columnSpan(4),

                    Toggle::make('is_published')
                        ->live()
                        ->columnSpanFull()->afterStateUpdated(function ($record, $state) {
                            FilamentForm::notification($state ? 'Status set to Active' : 'Status set to in active');
                        }),
                ]),

            ]),
       
        ]),
            // Group::make()
            //     ->schema([
                   

            //     ])->columnSpan(['lg' => 2]),
            // Group::make()
            //     ->schema([

                   

            //     ])->columnSpan(['lg' => 1]),



        ];
    }
    public static function conditionForm(): array
    {
        return [
            Group::make()
                ->schema([
                    Section::make('CONDITION DETAILS')
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 8,
                        ])
                        ->schema([
                            TextInput::make('name')
                                ->required()
                                ->columnSpanFull()
                                ->maxLength(191),


                            RichEditor::make('description')->toolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'bulletList',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'redo',
                                'strike',
                                'underline',
                                'undo',
                            ])
                                ->columnSpanFull(),

                            // Textarea::make('content')
                            //     ->columnSpanFull(),


                            Group::make()
                                ->relationship('file')
                                ->schema([

                                    FileUpload::make('file')
                                        ->disk('public')
                                        ->directory('events')
                                        ->image()
                                        ->imageEditor()
                                        // ->required()
                                        ->columnSpanFull()
                                        ->label('IMAGE'),

                                ])->columnSpanFull(),

                        ]),

                ])->columnSpan(['lg' => 3]),


            // ...FilamentForm::personalDetailForm()

        ];
    }
    public static function conditionForm2(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->columnSpanFull()
                ->maxLength(191),


            RichEditor::make('description')->toolbarButtons([
                'attachFiles',
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'h2',
                'h3',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'underline',
                'undo',
            ])
                ->columnSpanFull(),

            // Textarea::make('content')
            //     ->columnSpanFull(),


            Group::make()
                ->relationship('file')
                ->schema([

                    FileUpload::make('file')
                        ->disk('public')
                        ->directory('events')
                        ->image()
                        ->imageEditor()
                        // ->required()
                        ->columnSpanFull()
                        ->label('IMAGE'),

                ])->columnSpanFull(),

        ];
    }
    public static function treatmentForm(): array
    {
        return [
            TextInput::make('name')
                ->columnSpanFull()
                ->required()
                ->maxLength(191),


            RichEditor::make('description')->toolbarButtons([
                'attachFiles',
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'h2',
                'h3',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'underline',
                'undo',
            ])
                ->required()

                ->columnSpanFull(),




            Group::make()
                ->relationship('file')
                ->schema([

                    FileUpload::make('file')
                        ->disk('public')
                        ->directory('events')
                        ->image()
                        ->imageEditor()

                        ->columnSpanFull()
                        ->label('IMAGE'),

                ])->columnSpanFull(),



        ];
    }
    public static function symptomForm(): array
    {
        return [



            RichEditor::make('description')->toolbarButtons([
                'attachFiles',
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'h2',
                'h3',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'underline',
                'undo',
            ])
                ->required()

                ->columnSpanFull(),




            Group::make()
                ->relationship('file')
                ->schema([

                    FileUpload::make('file')
                        ->disk('public')
                        ->directory('events')
                        ->image()
                        ->imageEditor()

                        ->columnSpanFull()
                        ->label('IMAGE'),

                ])->columnSpanFull(),



        ];
    }

    public static function firstAidGuideForm(): array
    {
        return [
            Select::make('condition_id')
                ->relationship(name: 'condition', titleAttribute: 'name')
                ->preload()
                ->searchable(['name', 'description'])->columnSpanFull(),


            TextInput::make('title')
                ->columnSpanFull()
                ->required()
                ->maxLength(191),


            RichEditor::make('content')->toolbarButtons([
                'attachFiles',
                'blockquote',
                'bold',
                'bulletList',
                'codeBlock',
                'h2',
                'h3',
                'italic',
                'link',
                'orderedList',
                'redo',
                'strike',
                'underline',
                'undo',
            ])
                ->required()

                ->columnSpanFull(),
        ];
    }

    public static function departmentForm(): array
    {
        return [


            TextInput::make('name')->required()->label('NAME')
                ->unique(ignoreRecord: true)
                ->columnSpanFull(),
            TextInput::make('abbreviation')->label('ABBREVIATION')
                ->unique(ignoreRecord: true),
            Select::make('role')
                ->default(User::STUDENT)
                ->required()
                ->label('GROUP')
                ->options(User::ROLES)

                ->searchable()
                ->live(),

            FileUpload::make('image')
                ->disk('public')
                ->directory('departments')
                ->image()
                ->imageEditor()
                // ->required()
                ->columnSpanFull()
                ->label('LOGO')
        ];
    }

    public static function courseForm(): array
    {
        return [

            Section::make('')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 9,
                ])
                ->schema([
                    TextInput::make('name')->required()->label('NAME')
                        ->unique(ignoreRecord: true,)
                        ->columnSpan(3),
                    TextInput::make('abbreviation')->label('ABBREVIATION')
                        ->unique(ignoreRecord: true,)
                        ->columnSpan(3),

                    Select::make('department_id')
                        ->required()
                        ->label('BUILDING/DEPARTMENT')
                        ->options(Department::studentDepartment()->get()->map(function ($d) {
                            return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                        })->pluck('name', 'id'))
                        ->searchable()
                        ->columnSpan(3)
                        ->createOptionForm(FilamentForm::departmentForm()),



                    TableRepeater::make('course_sections')
                        ->relationship('sections')
                        ->schema([
                            TextInput::make('name')->required(),

                        ])
                        ->withoutHeader()


                        ->columnSpan('full')
                        ->label('Sections')

                ]),


            // Select::make('sections')
            //         ->label('Sections')
            //         ->multiple()
            //         ->relationship('sections', 'id')
            //         ->preload()
            //         ->options(
            //             MSection::all()->pluck('name', 'id')
            //         ),
            // Select::make('sections')

            // ->label('Sections')
            // ->multiple()
            // ->relationship('sections', 'name')
            // ->preload()
            // ->options(
            //     MSection::all()->pluck('name', 'id')
            // ),



        ];
    }

    public static function recordForm(): array
    {
        return [

            Section::make('RECORD DETAILS')
                ->description('This will create a collection of medical records')
                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 8,
                ])
                ->schema([
                    Textarea::make('title')
                        ->columnSpanFull()
                        ->required(),

                     

                    Section::make('')
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 9,
                        ])
                        ->hidden(fn (string $operation): bool => $operation == 'App\Livewire\Records\EditRecord')
                        ->schema([
                            Select::make('academic_year_id')
                                ->live(debounce: 500)
                                ->afterStateUpdated(function ($state, Get $get, Set $set) {

                                    $set('semester_id', null);
                                })
                                ->getOptionLabelFromRecordUsing(fn (AcademicYear $academicYear) => "#{$academicYear->name}")
                                ->hidden(fn (string $operation): bool => $operation == 'App\Livewire\Records\EditRecord')
                                ->required()
                                ->label('ACADEMIC YEAR')
                                // ->native(false)
                                ->options(AcademicYear::withSemesterWithoutRecord()->pluck('name', 'id'))
                                ->preload()
                                ->columnSpan(3)
                                ->searchable(),

                            Select::make('semester_id')->options(function (Get $get) {
                                if (!empty($get('academic_year_id'))) {
                                    return Semester::noRecord()->where('academic_year_id', $get('academic_year_id'))->get()->map(function ($a) {
                                        return [
                                            'name_in_number' => $a->semesterWithYear(),
                                            'id' => $a->id,
                                        ];
                                    })->pluck('name_in_number', 'id');
                                } else {
                                    return [];
                                }
                                
                            })
                            ->hidden(fn (string $operation): bool => $operation == 'App\Livewire\Records\EditRecord')
                                ->required()
                                ->native(false)
                                ->label('SEMESTER')
                                ->columnSpan(3),
                                DatePicker::make('record_date')->native(false)->columnSpan(3)->date()->required()->label('DATE')->default(now()),
                        ]),

                        ...FilamentForm::batchForm()
                    
                ]),



            

        ];
    }

    public static function batchForm(): array
    {
        return [
            Section::make('BATCH (Optional)')
            
                ->description('You can Record medical history by batches')
                ->collapsible()

                ->columns([
                    'sm' => 3,
                    'xl' => 6,
                    '2xl' => 8,
                ])
                ->schema([


                    Repeater::make('recordBatches')
                    ->live()
                   
                    ->grid(3)
                    ->columns([
                        'sm' => 1,
                        'xl' => 1,
                        '2xl' => 8,
                    ])
                    ->relationship('recordBatches')
                        
                        
                        ->schema([

                            TextInput::make('description')->required()
                            ->default('Batch 1')
                            ->placeholder('ex. Batch 1')
                            ->columnSpanfull()
                            ->label('Description'),

                        Select::make('department_id')
                            ->live(debounce: 500)
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                $set('course_id', null);
                                $set('section_id', null);


                            })
                            ->required()
                            ->label('DEPARTMENT/BUILDING')
                            ->options(Department::pluck('name', 'id'))
                            ->preload()
                            ->columnSpanfull()
                            ->searchable(),

                        Select::make('course_id')
                            ->live(debounce: 500)
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                                $set('section_id', null);
                               
                            })
                            ->hidden(fn (Get $get) => !empty($get('department_id')) ? Department::find($get('department_id'))->role !== User::STUDENT : true)

                            
                           
                            ->required()
                            ->label('Course')
                            ->options(function(Get $get){
                                if (!empty($get('department_id'))) {
                                            return Course::where('department_id', $get('department_id'))->get()->pluck('name', 'id');
                                        } else {
                                            return [];
                                        }
                            })
                            ->hidden(fn (Get $get) => !empty($get('department_id')) ? Department::find($get('department_id'))->role !== User::STUDENT : true)
                            ->preload()
                            ->columnSpanfull()
                          
                            
                            ->searchable(),

                            Select::make('section_id')
                            ->live(debounce: 500)
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {
                              
                                //$set('section_id', null);
                            })

                            ->distinct()
                            ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                            ->hidden(fn (Get $get) => !empty($get('department_id')) ? Department::find($get('department_id'))->role !== User::STUDENT : true)
                            ->required()
                            ->label('Section')
                            ->options(function(Get $get){
                                if (!empty($get('course_id'))) {
                                            return MSection::where('course_id', $get('course_id'))->get()->pluck('name', 'id');
                                        } else {
                                            return [];
                                        }
                            })
                           
                            ->preload()
                            ->columnSpanfull()
                            ->searchable(),
                                



                        ])
                        ->cloneable()
                        
                        // ->withoutHeader()
                        ->maxItems(20)
                        ->addActionLabel('Add Batch')
                        ->columnSpan('full')
                        ->label('BATCH')
                ]),



        ];
    }

    public static function medicalForm(): array
    {
        return [

            Section::make('Physical Examination Form')

                ->collapsible()

                ->schema([



                    Section::make('Personal Information')
                        // ->description('The following section contains fields for entering and managing personal details. Please fill out the required information accurately.')
                        ->collapsible()

                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 12,
                        ])
                        ->schema([
                            TextInput::make('first_name')->maxLength(191)->columnSpan(3)->required(),
                            TextInput::make('last_name')->maxLength(191)->columnSpan(3)->required(),
                            TextInput::make('middle_name')->maxLength(191)->columnSpan(3)->required(),
                            TextInput::make('email')->required()
                                                    ->columnSpan(3),

                                                    TextInput::make('age')
                                                    ->required()
                                                    ->mask(999)
                                                    ->live()
                                                    ->debounce(700)
                    
                                                ->afterStateUpdated(function(Get $get, Set $set){
                                                
                                                    FilamentForm::changeBloodPressure($get, $set);
                                                    FilamentForm::changeRiskLevel($get, $set);
                                                })
                                ->default(18)
                                ->numeric()
                                ->columnSpan(1),


                            DatePicker::make('birth_date')
                                ->required()
                                ->native(false)
                                ->columnSpan(2),

                            Select::make('civil_status')
                                ->required()
                                ->label('Civil Status')
                                ->options(FilamentForm::CIVIL_STATUS_OPTIONS)
                                ->default('Single')
                                ->columnSpan(3)
                                ->searchable(),

                            TextInput::make('birth_place')
                                ->required()
                                ->columnSpan(3),

                            TextInput::make('address')
                                ->required()
                                ->columnSpan(3),


                        ]),
                    //    TextInput::make('record_title')
                    //             ->maxLength(191),
                    //        TextInput::make('batch_description')
                    //             ->maxLength(191),
                    //        TextInput::make('academic_year_name')
                    //             ->maxLength(191),
                    //        TextInput::make('semester_name')
                    //             ->maxLength(191),
                    //        TextInput::make('department_name')
                    //             ->maxLength(191),
                    //        Textarea::make('course_name')
                    //             ->columnSpanFull(),
                    //        TextInput::make('section_name')
                    //             ->maxLength(191),
                    //        TextInput::make('student_unique_id')
                    //             ->maxLength(191),
                    //    TextInput::make('role')
                    //         ->maxLength(191),


                    Section::make('Vital Signs & Diagnosis')
                        // ->description('The following section contains fields for entering and managing medical details. ')
                        // ->extraAttributes([
                        //     'class' => 'section-bg'

                        // ])
                        ->collapsible()
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 12,
                        ])
                        ->schema([

                            TextInput::make('past_illness')

                                ->columnSpan(6),

                            TextInput::make('allergies')->label('Allergies (Food, Drugs, Etc.)')





                                ->columnSpan(4),

                            // TextInput::make('specified_diagnoses')


                            //     ->columnSpan(3),

                            // TextInput::make('condition_name')


                            //     ->columnSpan(3),


                            TextInput::make('weight')
                                ->numeric()->columnSpan(1),
                            TextInput::make('height')->label('Height (cm)')
                                ->columnSpan(1)
                                ->numeric()

                                ->maxValue(1000)
                                ->numeric(),


                            TextInput::make('temperature')->label('Temperature (°C)')
                                ->columnSpan(1)
                                ->numeric()

                                ->maxValue(150),




                                TextInput::make('systolic_pressure')
                                ->live()
                                ->debounce(700)
                                ->afterStateUpdated(function(Get $get, Set $set){
                                
                                    FilamentForm::changeBloodPressure($get, $set);
                                    FilamentForm::changeRiskLevel($get, $set);
                                })
                                    ->columnSpan(1)
                                    ->maxValue(1000)
    
                                    ->numeric(),
                                TextInput::make('diastolic_pressure')
                                    ->columnSpan(1)
                                    ->maxValue(1000)
                                    ->live()
                                    ->debounce(700)
    
                                    ->afterStateUpdated(function(Get $get, Set $set){
                                    
                                        FilamentForm::changeBloodPressure($get, $set);
                                        
                                    
                                         FilamentForm::changeRiskLevel($get, $set);
                                    })
    
                                    ->numeric(),
                            
                                    // ->afterStateUpdated(function(Get $get, Set $set){
                                    
                                    //     FilamentForm::changeBloodPressure($get, $set);
                                    // })
    
                                   
    
    
                                TextInput::make('blood_pressure')
                                    ->columnSpan(1)
    
                                    ->maxLength(191),
    
                                    TextInput::make('risk_level_status')
                                    ->label('BP RISK level')
                                        ->columnSpan(2)
                                        ->maxValue(1000)
                                        ->live()
                                        ->disabled()
                                        ->readOnly()
                                       
                                        ->debounce(300),


                       




                            TextInput::make('heart_rate')->label('Heart Rate (bpm)')
                                ->columnSpan(1)
                                ->maxValue(1000)
                                ->numeric(),


                            Select::make('condition_id')
                                ->relationship(name: 'condition', titleAttribute: 'name')

                                ->label('Diagnosis')
                                // ->options(Condition::get()->map(function ($item) {
                                //     return 
                                //     ['name' => $item->name, 'id' => $item->id] ;
                                // })->pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->columnSpan(4)
                                ->createOptionForm(FilamentForm::conditionForm2()),

                            Textarea::make('remarks')
                                ->columnSpanFull()->rows(1),

                            FileUpload::make('upload_image')
                                ->disk('public')
                                ->directory('events')
                                ->image()
                                ->imageEditor()
                                // ->required()
                                ->columnSpanFull(),

                        ]),

                    Section::make('Consultation Details')
                        ->description('')
                        ->collapsible()
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 12,
                        ])
                        ->schema([

                            DatePicker::make('date_of_examination')
                                ->date()
                                ->required()
                                ->columnSpan(4),
                            TextInput::make('release_by')
                                ->required()

                                ->columnSpan(4)
                                ->maxLength(191),
                            TextInput::make('physician_name')
                                ->required()

                                ->columnSpan(4)
                                ->maxLength(191),

                            // TextInput::make('status')
                            //     ->columnSpan(2)
                            //     ->maxLength(191)
                            //     ->default('No Record'),



                            Toggle::make('is_complete')->label('Mark as Complete')
                                ->columnSpanFull()
                                ->default(true)
                                ->live()
                                ->afterStateUpdated(function ($state) {
                                    FilamentForm::notification($state ? 'Marks as  Complete' : ' Marks as Incomplete');
                                }),

                            // FileUpload::make('captured_image')
                            //     ->disk('public')
                            //     ->directory('events')
                            //     ->image()
                            //     ->imageEditor()
                            //     // ->required()
                            //     ->columnSpan(6)
                            // ->label('FEATURED IMAGE'),
                            // Textarea::make('upload_image')
                            //     ->columnSpanFull(),
                            // Textarea::make('captured_image')
                            //     ->columnSpanFull(),

                        ]),

                ]),

        ];
    }
    public static function editMedicalForm(): array
    {
        return [

            

            Section::make('Physical Examination Form')

                ->collapsible()

                ->schema([



                    Section::make('Personal Information')
                        // ->description('The following section contains fields for entering and managing personal details. Please fill out the required information accurately.')
                        ->collapsible()

                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 12,
                        ])
                        ->schema([
                            TextInput::make('first_name')->maxLength(191)->columnSpan(3)->required()->disabled(),
                            TextInput::make('last_name')->maxLength(191)->columnSpan(3)->required()->disabled(),
                            TextInput::make('middle_name')->maxLength(191)->columnSpan(3)->required()->disabled(),
                            TextInput::make('email')->required()
                                                    ->columnSpan(3),

                            TextInput::make('age')
                                ->required()
                                ->mask(999)
                                ->live()
                                ->debounce(700)

                            ->afterStateUpdated(function(Get $get, Set $set){
                            
                                FilamentForm::changeBloodPressure($get, $set);
                                FilamentForm::changeRiskLevel($get, $set);
                            })
                                ->default(18)
                                ->numeric()
                                ->columnSpan(1),


                            DatePicker::make('birth_date')
                                ->required()
                                ->native(false)
                                ->columnSpan(2),

                            Select::make('civil_status')
                                ->required()
                                ->label('Civil Status')
                                ->options(FilamentForm::CIVIL_STATUS_OPTIONS)
                                ->default('Single')
                                ->columnSpan(3)
                                ->searchable(),

                            TextInput::make('birth_place')
                                ->required()
                                ->columnSpan(3),

                            TextInput::make('address')
                                ->required()
                                ->columnSpan(3),


                        ]),
                    //    TextInput::make('record_title')
                    //             ->maxLength(191),
                    //        TextInput::make('batch_description')
                    //             ->maxLength(191),
                    //        TextInput::make('academic_year_name')
                    //             ->maxLength(191),
                    //        TextInput::make('semester_name')
                    //             ->maxLength(191),
                    //        TextInput::make('department_name')
                    //             ->maxLength(191),
                    //        Textarea::make('course_name')
                    //             ->columnSpanFull(),
                    //        TextInput::make('section_name')
                    //             ->maxLength(191),
                    //        TextInput::make('student_unique_id')
                    //             ->maxLength(191),
                    //    TextInput::make('role')
                    //         ->maxLength(191),


                    Section::make('Vital Signs & Diagnosis')
                        // ->description('The following section contains fields for entering and managing medical details. ')
                        // ->extraAttributes([
                        //     'class' => 'section-bg'

                        // ])
                        ->collapsible()
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 12,
                        ])
                        ->schema([

                            TextInput::make('past_illness')

                                ->columnSpan(6),

                            TextInput::make('allergies')->label('Allergies (Food, Drugs, Etc.)')





                                ->columnSpan(4),

                            // TextInput::make('specified_diagnoses')


                            //     ->columnSpan(3),

                            // TextInput::make('condition_name')


                            //     ->columnSpan(3),


                            TextInput::make('weight')
                                ->numeric()->columnSpan(1),
                            TextInput::make('height')->label('Height (cm)')
                                ->columnSpan(1)
                                ->numeric()

                                ->maxValue(1000)
                                ->numeric(),


                            TextInput::make('temperature')->label('Temperature (°C)')
                                ->columnSpan(1)
                                ->numeric()

                                ->maxValue(150),





                            TextInput::make('systolic_pressure')
                            ->live()
                            ->debounce(700)
                            ->afterStateUpdated(function(Get $get, Set $set){
                            
                                FilamentForm::changeBloodPressure($get, $set);
                                FilamentForm::changeRiskLevel($get, $set);
                            })
                                ->columnSpan(1)
                                ->maxValue(1000)

                                ->numeric(),
                            TextInput::make('diastolic_pressure')
                                ->columnSpan(1)
                                ->maxValue(1000)
                                ->live()
                                ->debounce(700)

                                ->afterStateUpdated(function(Get $get, Set $set){
                                
                                    FilamentForm::changeBloodPressure($get, $set);
                                    
                                    // dd($get('risk_level_status'));
                                     FilamentForm::changeRiskLevel($get, $set);
                                })

                                ->numeric(),
                        
                                // ->afterStateUpdated(function(Get $get, Set $set){
                                
                                //     FilamentForm::changeBloodPressure($get, $set);
                                // })

                               


                            TextInput::make('blood_pressure')
                                ->columnSpan(1)

                                ->maxLength(191),

                                TextInput::make('risk_level_status')
                                ->label('BP RISK level')
                                    ->columnSpan(2)
                                    ->maxValue(1000)
                                    ->live()
                                    ->disabled()
                                    ->readOnly()
                                   
                                    ->debounce(300),




                            TextInput::make('heart_rate')->label('Heart Rate (bpm)')
                                ->columnSpan(1)
                                ->maxValue(1000)
                                ->numeric(),


                            Select::make('condition_id')
                                ->relationship(name: 'condition', titleAttribute: 'name')

                                ->label('Diagnosis')
                                // ->options(Condition::get()->map(function ($item) {
                                //     return 
                                //     ['name' => $item->name, 'id' => $item->id] ;
                                // })->pluck('name', 'id'))
                                ->searchable()
                                ->preload()
                                ->columnSpan(5)
                                ->createOptionForm(FilamentForm::conditionForm2()),

                            Textarea::make('remarks')
                                ->columnSpanFull()->rows(1),

                            FileUpload::make('upload_image')
                                ->disk('public')
                                ->directory('events')
                                ->image()
                                ->imageEditor()
                                // ->required()
                                ->columnSpanFull(),

                        ]),

                    Section::make('Consultation Details')
                        ->description('')
                        ->collapsible()
                        ->columns([
                            'sm' => 3,
                            'xl' => 6,
                            '2xl' => 12,
                        ])
                        ->schema([

                            DatePicker::make('date_of_examination')
                                ->date()
                                ->required()
                                ->columnSpan(4),
                            TextInput::make('release_by')
                                ->required()

                                ->columnSpan(4)
                                ->maxLength(191),
                            TextInput::make('physician_name')
                                ->required()

                                ->columnSpan(4)
                                ->maxLength(191),

                            // TextInput::make('status')
                            //     ->columnSpan(2)
                            //     ->maxLength(191)
                            //     ->default('No Record'),



                            Toggle::make('is_complete')->label('Mark as Complete')
                                ->columnSpanFull()
                                ->live()
                                ->afterStateUpdated(function ($state) {
                                    FilamentForm::notification($state ? 'Marks as  Complete' : ' Marks as Incomplete');
                                }),

                            // FileUpload::make('captured_image')
                            //     ->disk('public')
                            //     ->directory('events')
                            //     ->image()
                            //     ->imageEditor()
                            //     // ->required()
                            //     ->columnSpan(6)
                            // ->label('FEATURED IMAGE'),
                            // Textarea::make('upload_image')
                            //     ->columnSpanFull(),
                            // Textarea::make('captured_image')
                            //     ->columnSpanFull(),

                        ]),

                ]),

        ];
    }
    public static function sectionForm(): array
    {
        return [
            TextInput::make('name')
                ->required()
                ->unique(ignoreRecord: true)
                ->columnSpan(2),
            Select::make('course_id')->label('Course')
                ->options(Course::all()->pluck('name', 'id'))
                ->preload()
                ->columnSpan(2)
                ->searchable(),

        ];
    }

    public static function changeBloodPressure(Get $get , Set $set){
        if (!empty($get('systolic_pressure')) && !empty($get('diastolic_pressure'))) {
            $bloodPressure = $get('systolic_pressure') . '/' . $get('diastolic_pressure');
            
            $set('blood_pressure', $bloodPressure);
        } else {
         
            $set('blood_pressure', null);
        }
    }


    public static function changeRiskLevel(Get $get, Set $set)
    {
        $systolic = $get('systolic_pressure');
        $diastolic = $get('diastolic_pressure');
        $age = $get('age');
    
        if (!empty($systolic) && !empty($diastolic) && !empty($age)) {
            if ($age < 13) {
                if ($systolic < 110 && $diastolic < 70) {
                    $set('risk_level_status', 'Normal');
                } elseif ($systolic >= 110 && $systolic <= 120 && $diastolic < 80) {
                    $set('risk_level_status', 'Elevated');
                } elseif ($systolic > 120 || $diastolic > 80) {
                    $set('risk_level_status', 'Hypertension');
                }
            } elseif ($age < 18) {
                if ($systolic < 120 && $diastolic < 80) {
                    $set('risk_level_status', 'Normal');
                } elseif ($systolic >= 120 && $systolic <= 130 && $diastolic < 80) {
                    $set('risk_level_status', 'Elevated');
                } elseif ($systolic > 130 || $diastolic > 80) {
                    $set('risk_level_status', 'Hypertension');
                }
            } else {
                if ($systolic < 120 && $diastolic < 80) {
                    $set('risk_level_status', 'Normal');
                } elseif ($systolic >= 120 && $systolic <= 129 && $diastolic < 80) {
                    $set('risk_level_status', 'Elevated');
                } elseif (($systolic >= 130 && $systolic <= 139) || ($diastolic >= 80 && $diastolic <= 89)) {
                    $set('risk_level_status', 'Hypertension Stage 1');
                } elseif ($systolic >= 140 || $diastolic >= 90) {
                    $set('risk_level_status', 'Hypertension Stage 2');
                } elseif ($systolic > 180 || $diastolic > 120) {
                    $set('risk_level_status', 'Hypertensive Crisis');
                }
            }
        } else {
            $set('risk_level_status', 'Unknown');
        }
    }
    

   
    
}
