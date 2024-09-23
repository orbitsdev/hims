<?php

namespace App\Livewire;

use App\Models\User;
use App\Models\Event;
use App\Models\Staff;
use App\Models\Record;
use App\Models\Student;
use Livewire\Component;
use App\Models\Semester;
use App\Models\Condition;
use App\Models\Personnel;
use Livewire\Attributes\On;
use App\Models\AcademicYear;
use Filament\Actions\Action;
use App\Models\MedicalRecord;
use App\Models\EmergencyContact;
use Filament\Actions\EditAction;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Http\Controllers\SendingEmailController;
use Filament\Actions\Concerns\InteractsWithActions;

class AdminDashboard extends Component implements HasForms, HasActions
{
    use InteractsWithActions;
    use InteractsWithForms;


    public $academicYears = [];
    public $semesters = [];
    public $selectedAcademicYear = null;
    public $selectedSemester = null;
    public $data = [];
    public $conditions = [];

    public function mount()
    {
        $this->loadAcademicYears();
        $this->loadSemesters();
        $this->fetchChartData();
    }

    // Load all academic years and set the default one
    private function loadAcademicYears()
    {
        $this->academicYears = AcademicYear::all();

        if ($this->academicYears->isNotEmpty()) {
            $this->selectedAcademicYear = $this->academicYears->first()->id;
        }
    }

    // Load semesters based on the selected academic year
    private function loadSemesters()
    {
        if ($this->selectedAcademicYear) {
            $this->semesters = Semester::where('academic_year_id', $this->selectedAcademicYear)->get();

            // Set the first semester as the default if it exists
            $this->selectedSemester = $this->semesters->first()->id ?? null;
        } else {
            $this->semesters = [];
            $this->selectedSemester = null;
        }
    }

    public function manageAction(): Action
    {
        return Action::make('download')

        ->color('primary')
        ->icon('heroicon-s-arrow-down-tray')
        ->tooltip('DONNLOAD REPORT')
        ->action(function(){
            FilamentForm::notification('DOWNLOAD REPORT COMING SOON');
        })
            ->url(function(array $arguments){
                $medicalRecord = MedicalRecord::find($arguments['record']);
                return route('reports.medical-record',['record'=> $medicalRecord]);
            })
            ->openUrlInNewTab()
            ;



    }
    public function sendSmsAction(): Action
    {
        return Action::make('sendSms')

        ->label('SEND SMS')
        ->icon('heroicon-s-chat-bubble-left-ellipsis')
        ->color('info')
        ->size('lg')
        ->requiresConfirmation()
        ->action(function(array $arguments){
            $medicalRecord = MedicalRecord::find($arguments['record']);
            FilamentForm::notification('DOWNLOAD REPORT COMING SOON');
        })
        ->tooltip('SEND MESSAGE TO USER');




    }

    public function sendEmailAction(): Action
    {
        return Action::make('sendEmail')

        ->tooltip('SEND EMAIL TO USER')
                    ->label('SEND EMAIL')
                    ->icon('heroicon-s-envelope')
                    ->color('info')
                    ->size('lg')

                    ->fillForm(function (array $arguments) {
                        $medicalRecord = MedicalRecord::find($arguments['record']);
                        return [
                            'to' => $medicalRecord->user->email,
                        ];
                    })
                    ->form([
                        TextInput::make('to')->required()->disabled()->label('To'),
                        Textarea::make('message')->required(),


                    ])
                    ->action(function (array $data, array $arguments) {
                        $medicalRecord = MedicalRecord::find($arguments['record']);
                        $owner= $medicalRecord->user;
                        if($owner){
                            FilamentForm::notification('SEND EMAIL TO  ' . $owner->fullNameWithEmail() . ' IS COMING SOON ' . $data['message']);
                            $medicalRecord->record->notificationRequests()->create([
                                'message' => $data['message'],
                                'email' => $owner->email
                            ]);
                        }

                    });




    }
    public function sendBloodEmailAlertAction(): Action
    {
        return Action::make('sendBloodEmailAlert')

        ->tooltip('NOTIFY USER BP STATUS BY SENDING EMAIL')
                    ->label('SEND BP EMAIL ALERT')
                    ->icon('heroicon-s-exclamation-circle')
                    ->color('info')
                    ->size('lg')
                    ->requiresConfirmation()
                   ->action(function (array $arguments) {
                    $medicalRecord = MedicalRecord::find($arguments['record']);

                      SendingEmailController::sendBPAlertEmail($medicalRecord);

                });




    }



    // Fetch and prepare chart data
    public function fetchChartData()
    {
        if ($this->selectedAcademicYear && $this->selectedSemester) {
            $this->conditions = Condition::whereHas('medicalRecords', function ($query) {
                $query->whereHas('record', function ($query) {
                    $query->where('academic_year_id', $this->selectedAcademicYear)
                        ->where('semester_id', $this->selectedSemester);
                });
            })
                ->withCount('medicalRecords')
                ->orderBy('medical_records_count', 'desc')
                ->limit(5)
                ->get();


                $academicYear = AcademicYear::find($this->selectedAcademicYear)->name;
                $semester = Semester::find($this->selectedSemester)->name_in_number;
            // Prepare chart data
            $this->data = [
                'labels' => $this->conditions->pluck('name')->toArray(),
                'datasets' => [
                    [
                       'label' => "Medical Records per Condition ({$academicYear}, {$semester})",
                        'backgroundColor' => 'rgba(40, 167, 69, 0.6)', // Light green with transparency
                        'borderColor' => 'rgba(40, 167, 69, 1)', // Darker green, fully opaque
                        'borderWidth' => 1,
                        'data' => $this->conditions->pluck('medical_records_count')->toArray(),
                    ]
                ]
            ];

            // Dispatch the updated chart data
            $this->dispatch('chart-updated', $this->data);
        }
    }

    // Handle updates when the academic year is changed
    public function updatedSelectedAcademicYear()
    {
        $this->loadSemesters();
        $this->fetchChartData();
    }

    // Handle updates when the semester is changed
    public function updatedSelectedSemester()
    {
        $this->fetchChartData();
    }

    // We could use #[On] here if needed for backend events, but for chart updates we use dispatch.

    public function render()
    {
        $total_users = User::hasAccountOwner()->count();
        $total_students = Student::whereHas('user')->count();
        $total_personnel = Personnel::whereHas('user')->count();
        $total_staff = Staff::where('status', true)->whereHas('user')->count();
        $total_screening = Record::where('academic_year_id', $this->selectedAcademicYear)->where('semester_id', $this->selectedSemester)->count();
        $total_medical_record = MedicalRecord::whereHas('record',function($query){
            $query->where('academic_year_id', $this->selectedAcademicYear)->where('semester_id', $this->selectedSemester);
        })->count();

        $total_events = Event::where('academic_year_id', $this->selectedAcademicYear)->where('semester_id', $this->selectedSemester)->count();
        $contacts = EmergencyContact::all();

        $total_not_normal_bp_record = MedicalRecord::whereHas('record', function($query) {
            $query->where('academic_year_id', $this->selectedAcademicYear)
                  ->where('semester_id', $this->selectedSemester);
        })->get()->filter(function($medicalRecord) {
            return $medicalRecord->getBloodPressureStatus() != 'Normal';
        });



        return view('livewire.admin-dashboard', [
            'total_users'=> $total_users ,
            'total_students'=> $total_students ,
            'total_personnel'=> $total_personnel ,
            'total_staff'=> $total_staff ,
            'total_screening'=> $total_screening ,
            'total_medical_record'=> $total_medical_record ,
            'total_not_normal_bp_record' => $total_not_normal_bp_record,
            'total_events'=> $total_events ,
            'contacts'=> $contacts ,
        ]);
    }
}
