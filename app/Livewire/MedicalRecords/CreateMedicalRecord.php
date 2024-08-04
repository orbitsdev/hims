<?php

namespace App\Livewire\MedicalRecords;

use Filament\Forms;
use App\Models\User;
use App\Models\Record;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\MedicalRecord;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateMedicalRecord extends Component implements HasForms
{
    use InteractsWithForms;
    public User $user;
    public Record $record;
    public ?array $data = [];

    public function mount(): void
    {   

        $personalDetails = $this->user->getPersonalDetailsBaseOnRole();
        $this->form->fill([
            'record_title'=> $this->record->title ??'',
            'academic_year_name'=> $this->record->academicYear->name ??'',
            'semester_name'=> $this->record->semester->name_in_number ??'',
            'department_name'=> $this->record->semester->name_in_number ??'',
           
        
        ]);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Forms\Components\TextInput::make('record_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('user_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('record_batch_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('section_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('course_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('department_id')
                //     ->numeric(),
                // Forms\Components\TextInput::make('condition_id')
                //     ->numeric(),
                Forms\Components\TextInput::make('record_title')
                    ->maxLength(191),
                Forms\Components\TextInput::make('batch_description')
                    ->maxLength(191),
                Forms\Components\TextInput::make('academic_year_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('semester_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('department_name')
                    ->maxLength(191),
                Forms\Components\Textarea::make('course_name')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('section_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('student_unique_id')
                    ->maxLength(191),
                Forms\Components\TextInput::make('role')
                    ->maxLength(191),
                Forms\Components\TextInput::make('first_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('last_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('middle_name')
                    ->maxLength(191),
                Forms\Components\TextInput::make('age')
                    ->numeric(),
                Forms\Components\TextInput::make('weight')
                    ->numeric(),
                Forms\Components\TextInput::make('height')
                    ->numeric(),
                Forms\Components\DatePicker::make('birth_date'),
                Forms\Components\Textarea::make('birth_place')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('address')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('civil_status')
                    ->maxLength(191),
                Forms\Components\Textarea::make('past_illness')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('allergies')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('temperature')
                    ->numeric(),
                Forms\Components\TextInput::make('blood_pressure')
                    ->maxLength(191),
                Forms\Components\TextInput::make('systolic_pressure')
                    ->numeric(),
                Forms\Components\TextInput::make('diastolic_pressure')
                    ->numeric(),
                Forms\Components\TextInput::make('heart_rate')
                    ->numeric(),
                Forms\Components\Textarea::make('specified_diagnoses')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('condition_name')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('remarks')
                    ->columnSpanFull(),
                Forms\Components\DatePicker::make('date_of_examination'),
                Forms\Components\TextInput::make('release_by')
                    ->maxLength(191),
                Forms\Components\TextInput::make('physician_name')
                    ->maxLength(191),
                Forms\Components\Textarea::make('upload_image')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('captured_image')
                    ->columnSpanFull(),
                Forms\Components\TextInput::make('status')
                    ->maxLength(191)
                    ->default('No Record'),
            ])
            ->statePath('data')
            ->model(MedicalRecord::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = MedicalRecord::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.medical-records.create-medical-record');
    }
}