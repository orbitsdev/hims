<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Course;
use Filament\Forms\Get;
use Filament\Forms\Set;
use App\Models\Semester;
use App\Models\Department;
use App\Models\AcademicYear;
use Illuminate\Http\Request;
use App\Models\Section as MSection;
use Filament\Forms\Components\Group;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Rawilk\FilamentPasswordInput\Password;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Components\DateTimePicker;
use Awcodes\FilamentTableRepeater\Components\TableRepeater;

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
                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()']),
                                    TextInput::make('middle_name')
                                        ->label('MIDDLE NAME')
                                        ->extraAttributes(['x-on:input' => 'event.target.value = event.target.value.toUpperCase()'])

                                        ->columnSpan(3),
                                    TextInput::make('last_name')
                                        ->label('LAST NAME')
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

                                        Select::make('civil_status')
                                        ->label('CIVIL STATUS')
                                        ->options([
                                            'Single' => 'Single',
                                            'Married' => 'Married',
                                            'Widowed' => 'Widowed',
                                            'Separated' => 'Separated',
                                            'Divorced' => 'Divorced',
                                            'Annulled' => 'Annulled',
                                            'reviewing' => 'Reviewing',
                                            'published' => 'Published',
                                        ])
                                        ->default('Single')
                                        ->columnSpan(2)
                                        ->searchable(),
                                    
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

                            Select::make('course_id')
                            ->live(debounce: 500)
                            ->afterStateUpdated(function ($state, Get $get, Set $set) {

                                $set('section_id', null);
                            })
                            ->required()
                            ->label('COURSE')

                            ->options(Course::pluck('name', 'id'))
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
                            ->columnSpan(3),
                            
                            Select::make('department_id')
                            ->required()
                            ->label('BUILDING/DEPARTMENT')
                            ->options(Department::where('name', '!=','All')->get()->map(function ($d) {
                                return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                            })->pluck('name', 'id'))
                            ->searchable()
                            ->columnSpan(3)
                            ->createOptionForm(FilamentForm::departmentForm())
                            
                            ,
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
                ...FilamentForm::personalDetailForm()
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
                ...FilamentForm::personalDetailForm()

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
                                ->options(Department::where('name', '!=','All')->get()->map(function ($d) {
                                    return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                                })->pluck('name', 'id'))
                                ->searchable()
                                ->columnSpan(2)
                                ->createOptionForm(FilamentForm::departmentForm())
                                
                                ,
                            

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

            ...FilamentForm::personalDetailForm()
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
                            DatePicker::make('event_date')->native(false)->columnSpanFull()->date()->required(),
                            // DatePicker::make('event_date_time')->columnSpan(4),

                            Toggle::make('is_published')
                                ->live()
                                ->columnSpanFull()->afterStateUpdated(function ($record, $state) {
                                    FilamentForm::notification($state ? 'Status set to Active' : 'Status set to in active');
                                }),
                        ]),


                ])->columnSpan(['lg' => 1]),



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
                      

            ...FilamentForm::personalDetailForm()

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

    public static function firstAidGuideForm():array{
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

    public static function departmentForm(): array {
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

    public static function courseForm()  : array {
        return [

            Section::make('')
            ->columns([
                'sm' => 3,
                'xl' => 6,
                '2xl' => 9,
            ])
            ->schema([
                TextInput::make('name')->required()->label('NAME')
                ->unique(ignoreRecord: true)
                 ->columnSpan(3),
                TextInput::make('abbreviation')->label('ABBREVIATION')
                ->unique(ignoreRecord: true, )
                ->columnSpan(3),

                Select::make('department_id')
                ->required()
                ->label('BUILDING/DEPARTMENT')
                ->options(Department::whereNotIn('name', ['All','Faculty'])->get()->map(function ($d) {
                    return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                })->pluck('name', 'id'))
                ->searchable()
                ->columnSpan(3)
                ->createOptionForm(FilamentForm::departmentForm())
                
                ,

            
                TableRepeater::make('course_sections')
                ->relationship('sections')
                ->schema([
                    Select::make('id')
                    ->label('SECTION')
                        ->hiddenLabel()
                        ->options(MSection::query()->pluck('name','id'))->disableOptionsWhenSelectedInSiblingRepeaterItems(),
                   
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
    
    public static function recordForm(): array{
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
            ->required()
            ,
        
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
                    ->required()
                        ->native(false)
                        ->label('SEMESTER')
                        ->columnSpan(4),
                    ]),

                    // Toggle::make('status')->label('STATUS')
                    // ->live()
                    // ->afterStateUpdated(function ($state) {
                    //     FilamentForm::notification('Status Was set to '. $state ? 'Active' : 'Inactive');
                    // })
                    // ,

                    ...FilamentForm::batchForm()
            ]),
            
           
           
            // TextInput::make('academic_year_name')
            //         ->maxLength(191),
            // TextInput::make('semester_name')
            //         ->maxLength(191),
           
        ];
    }

    public static function batchForm() : array{
        return [
            Section::make('BATCHES (Optional)')
            ->description('You can Record medical history by batches')
            ->collapsible()
          
            ->columns([
                'sm' => 3,
                'xl' => 6,
                '2xl' => 8,
            ])
            ->schema([
             

              TableRepeater::make('recordBatches')
             
              ->columnWidths([
              
                'section_id' => '600px',
            ])
            ->relationship('recordBatches')
            ->schema([
                TextInput::make('description')->required()->label('description')
                ->unique(ignoreRecord: true)
                ->default('Batch 1')
                ->placeholder('ex. Batch 1')
                 ->columnSpanFull()->label('Description'),
                Select::make('department_id')
                ->live(debounce: 500)
                ->afterStateUpdated(function ($state, Get $get, Set $set) {
    
                    $set('section_id', null);
                })
                ->required()
                ->label('DEPARTMENT')
    
                ->options(Department::pluck('name', 'id'))
                ->preload()
                ->columnSpan(4)
                ->searchable(),
                // ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                // ,
    
            Select::make('section_id')->options(function (Get $get) {
                if (!empty($get('department_id'))) {
                    return MSection::whereHas('course.department', function($query) use($get){
                        $query->where('id', $get('department_id'));
                    })->get()->pluck('name', 'id');
                } else {
                    return [];
                }
            })
            ->required()
                ->native(false)
                ->label('SECTION')
                ->columnSpan(4)
                ->disableOptionsWhenSelectedInSiblingRepeaterItems()
                ->hidden(function($state, Get $get, Set $set){
                    if(!empty($get('department_id'))){
                       $department = Department::findOrFail($get('department_id'));
                        return $department->role != User::STUDENT;
                    }

                    return true;
                   
                })
                ,

             
               
            ])
            ->withoutHeader()
          
            // ->defaultItems(0)
            ->addActionLabel('Add Batch')
            ->columnSpan('full')
            ->label('BATCH')
            ]),
            
          

        ];
    }
}
