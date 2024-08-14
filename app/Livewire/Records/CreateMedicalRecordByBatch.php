<?php

namespace App\Livewire\Records;

use Filament\Forms;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\RecordBatch;
use App\Models\MedicalRecord;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use App\Http\Controllers\MedicalController;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateMedicalRecordByBatch extends Component implements HasForms
{
    use InteractsWithForms;
    public User $user;
    public RecordBatch $record;
    public ?array $data = [];

    public function mount(): void
    {

        
        $personalDetails = $this->user->getPersonalDetailsBaseOnRole();
       
        $formData = [
           
            'first_name' => $personalDetails->first_name ?? null,
            'last_name' => $personalDetails->last_name ?? null,
            'middle_name' => $personalDetails->middle_name ?? null,
            'email'=>$this->user->email ?? null,   
            'age' => $personalDetails->age ?? null,
            'weight' => $personalDetails->weight ?? null,
            'height' => $personalDetails->height ?? null,
            'birth_date' => $personalDetails->birth_date ?? null,
            'birth_place' => $personalDetails->birth_place ?? null,
            'address' => $personalDetails->address ?? null,
            'civil_status' => $personalDetails->civil_status ?? null,
        ];

        $this->form->fill($formData);
    }

    public function form(Form $form): Form
    {
        return $form
        ->schema(FilamentForm::medicalForm())
            ->statePath('data')
            ->model(MedicalRecord::class);
    }

    public function create()
    
    {
        
        
        $department= $this->user->getDepartmentBaseOnRole();
        $newrecord = $this->record->record;
        $academicYear =$newrecord->academicYear;
        $semester =$newrecord->semester;
        $student =null;
        $course = null;
        $section = null;
       
        
        if($this->user->role == User::STUDENT){
            $section= $this->user->section;
            $student = $this->user->student;    
            $course = $this->user->student->course;    
            $section = $this->user->student->section;    
        }

        $data = $this->form->getState();

        $data['record_id']=  $newrecord->id ?? null;
        $data['record_title']=  $newrecord->title ?? null;
        $data['record_batch_id']=  $this->record->id ?? null;
        $data['batch_description']=  $this->record->description ?? null;
        $data['user_id']=  $this->user->id ?? null;
        $data['section_id']= $section->id ?? null;
        $data['department_id']=  $department->id ?? null;
        $data['academic_year_name']=  $academicYear->name ?? null;
        $data['semester_name']=  $semester->name_in_text ?? null;
        $data['department_name']= $department->name ?? null;
        $data['course_name']=  $course->name ?? null;
        $data['section_name']=  $section->name ?? null;
        $data['student_unique_id']= $student->unique_id ?? null;
        $data['student_id_number']= $student->id_number ?? null;
        $data['recorder_id']= Auth::user()->id ?? null;
        $data['role']=  $this->user->role ?? null;
     
        

        $record = MedicalRecord::create($data);

        $this->form->model($record)->saveRelationships();

        MedicalController::automaticChangeStatus($this->record->record);
        $this->record->refresh();


        FilamentForm::notification('Save Successfully');

        return redirect()->route('batches',['record'=> $record->record->id]);
    }

    public function render(): View
    {
        return view('livewire.records.create-medical-record-by-batch');
    }
}