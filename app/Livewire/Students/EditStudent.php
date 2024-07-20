<?php

namespace App\Livewire\Students;

use Filament\Forms;
use App\Models\User;
use App\Models\Student;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class EditStudent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Student $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
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
                                ->options(User::studentAccountNotRegistered()->pluck('name', 'id'))->searchable()

                                ->columnSpan(3)
                                ->searchable(),
                            // Forms\Components\TextInput::make('unique_id')
                            // ->required()
                            //     //     ->maxLength(191),
                            Forms\Components\TextInput::make('id_number')->label('ID NUMBER')
                                ->unique()
                                ->required()
                                ->columnSpan(3),


                            //   Forms\Components\TextInput::make('department_id')
                            //     ->required()
                            //     ->label('COLLEGE DEPARTMENT')
                            //     ->columnSpan(3)
                            //     ->numeric(),

                            Select::make('department')
                                ->required()
                                ->label('DEPARTMENT')
                                ->default(Department::CCS)
                                ->options(Department::LIST)
                                ->searchable()
                                ->columnSpan(3),
                            // Forms\Components\TextInput::make('department')
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
                        ->label('IMAGE as Student')
                ]),




             ...FilamentForm::personalDetailForm()
            ])
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.students.edit-student');
    }
}
