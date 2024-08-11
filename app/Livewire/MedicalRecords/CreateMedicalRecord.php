<?php

namespace App\Livewire\MedicalRecords;

use Filament\Forms;
use App\Models\User;
use App\Models\Record;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\MedicalRecord;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use App\Http\Controllers\MedicalController;
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


        // $department= $this->user->getDepartmentBaseOnRole();
        // $academicYear = $this->record->academicYear;
        // $semester = $this->record->semester;
        // $student =null;
        // $course = null;
        // $section = null;
       

    

        
        if($this->user->role == User::STUDENT){
            // $section= $this->user->section;
            // $student = $this->user->student;    
            // $course = $this->user->student->course;    
            // $section = $this->user->student->section;    
        }

        $this->form->fill([

            // // RELATIONSHIP
         
            // 'record_id'=> $this->record->id,           
            // 'user_id'=> $this->user->id,                   
            // 'section_id'=> $section->id,
            // 'department_id'=> $department->id,
            
            
            // 'record_title'=> $this->record->title,          
            // 'academic_year_name'=> $academicYear->name,          
            // 'semester_name'=> $semester->name_in_text,          
            
            // 'department_name'=> $department->name,          
            // 'course_name'=>$course->name,          
            // 'section_name'=>$section->name,          
            // 'student_unique_id'=>$student->unique_id,          
            // 'role'=>$this->user->role,       
            
            
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


       
        $department= $this->user->getDepartmentBaseOnRole();
        $academicYear = $this->record->academicYear;
        $semester = $this->record->semester;
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

        $data['record_id']=  $this->record->id?? null;
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
     
        
        $newRecord = MedicalRecord::create($data);

        $this->form->model($newRecord)->saveRelationships();

        MedicalController::automaticChangeStatus($this->record);
        $this->record->refresh();
      
        FilamentForm::notification('Save Successfully');

        return redirect()->route('individual-medical-recoding',['record'=> $this->record->id]);

    }



    public function render(): View
    {

        
        return view('livewire.medical-records.create-medical-record');
    }
   
}