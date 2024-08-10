<?php

namespace App\Livewire\Records;

use Filament\Forms;
use App\Models\User;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\RecordBatch;
use App\Models\MedicalRecord;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
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
        $department= $this->user->getDepartmentBaseOnRole();
        $newrecord = $this->record->record;


        $academicYear = $newrecord->academicYear;
        $semester = $newrecord->semester;
        $student =null;
        $course = null;
        $section = null;
       

    

        
        if($this->user->role == User::STUDENT){
            $section= $this->user->section;
            $student = $this->user->student;    
            $course = $this->user->student->course;    
            $section = $this->user->student->section;    
        }

        $this->form->fill([

            // RELATIONSHIP
         
            'record_id'=> $newrecord->id??null,           
            'user_id'=> $this->user->id ?? null,                   
            'section_id'=> $section?->id??null,
            'department_id'=> $department?->id ?? null,
            
            
            'record_title'=> $newrecord->title ?? null,          
            'academic_year_name'=> $academicYear?->name ?? null,          
            'semester_name'=> $semester?->name_in_text ?? null,          
            
            'department_name'=> $department->name ?? null,          
            'course_name'=>$course?->name??null,          
            'section_name'=>$section?->name ?? null,          
            'student_unique_id'=>$student->unique_id ?? null,          
            'role'=>$this->user->role,       
            
            
            // PERSONAL DETAILS
            'first_name'=>$personalDetails->first_name,          
            'last_name'=>$personalDetails->last_name,                
            'middle_name'=>$personalDetails->middle_name,          
            'age'=>$personalDetails->age,          
            'weight'=>$personalDetails->weight,          
            'height'=>$personalDetails->height,          
            'birth_date'=>$personalDetails->birth_date,          
            'birth_place'=>$personalDetails->birth_place,          
            'address'=>$personalDetails->address,          
            'civil_status'=>$personalDetails->civil_status,          

        ]);
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
        $data = $this->form->getState();

        $record = MedicalRecord::create($data);

        $this->form->model($record)->saveRelationships();


        FilamentForm::notification('Save Successfully');

        return redirect()->route('batches',['record'=> $record->record->id]);
    }

    public function render(): View
    {
        return view('livewire.records.create-medical-record-by-batch');
    }
}