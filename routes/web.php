
<?php


use App\Livewire\Dashboard;
use App\Livewire\Notifications\EventsAnouncmentSMSStatus;
use App\Livewire\Records\ListOfUserForIndividualScreening;
use App\Livewire\Users\EditUser;
use App\Livewire\Users\ListUser;
use App\Livewire\Events\EditEvent;
use App\Livewire\Events\ViewEvent;
use App\Livewire\Staffs\EditStaff;
use App\Livewire\Staffs\ViewStaff;
use App\Livewire\User\UserDetails;
use App\Livewire\Users\CreateUser;
use App\Livewire\Events\ListEvents;
use App\Livewire\Staffs\ListStaffs;
use App\Livewire\Usesr\EditProfile;
use App\Livewire\Events\CreateEvent;
use App\Livewire\Staffs\CreateStaff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Students\EditStudent;
use App\Livewire\Students\ViewStudent;
use App\Livewire\Students\ListStudents;
use Filament\Tables\Actions\EditAction;
use App\Livewire\Emergency\ListContacts;
use App\Livewire\Students\CreateStudent;
use App\Livewire\Personels\EditPersonnel;
use App\Livewire\Conditions\EditCondition;
use App\Livewire\Conditions\ListCondtions;
use App\Livewire\Conditions\ViewCondition;
use App\Livewire\Personnels\ViewPersonnel;
use App\Livewire\Conditions\ListConditions;
use App\Livewire\Personels\CreatePersonnel;
use App\Livewire\Personnels\ListPersonnels;
use App\Livewire\Conditions\ManageCondition;
use App\Livewire\Conditions\ManageConditions;
use App\Livewire\Departments\ListDepartments;
use App\Livewire\AcademicYear\ListAcademicYear;
use App\Livewire\Condition\ViewTreatmentCondition;
use App\Livewire\Conditions\CondtionTreatmentLists;
use App\Livewire\Conditions\ListConditionSymptoms;
use App\Livewire\Conditions\ListConditionTreatments;
use App\Livewire\Courses\CreateCourse;
use App\Livewire\Courses\EditCourse;
use App\Livewire\Courses\ListCourses;
use App\Livewire\FirstAidFuides\ViewFirstAidGuide;
use App\Livewire\FirstAidGuides\CreateFirstAidGuide;
use App\Livewire\FirstAidGuides\ListFirstAidGuide;
use App\Livewire\FirstAidGuides\ListFirstAidGuides;
use App\Livewire\MedicalRecords\CreateMedicalRecord;
use App\Livewire\Records\CreateRecord;
use App\Livewire\Records\EditRecord;
use App\Livewire\Records\ListRecords;
use App\Livewire\Symptoms\ListSymptoms;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    
    return redirect()->route('dashboard');
});

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function(){
        
        return Auth::user()->dashBoardBaseOnRole();

    })->name('dashboard');

    Route::get('/unauthorizepage', function(){
        
        return 'UnAuthorize';

    })->name('unauthorizepage');



    Route::middleware('')->group(function(){

    });

    // SYSTEM SUERS
    Route::get('/users', ListUser::class)->name('users');
    Route::get('/user/edit/{record}', EditProfile::class)->name('edit-profile');
    Route::get('/user-create', CreateUser::class)->name('user-create');
    Route::get('/user-edit/{record}', EditUser::class)->name('user-edit');
    Route::get('/user-details/{record}', UserDetails::class)->name('details');
    
    Route::get('/college-departments', ListDepartments::class)->name('departments');

    Route::get('/students', ListStudents::class)->name('students');
    Route::get('/student-create', CreateStudent::class)->name('create-student');
    Route::get('/student-edit/{record}', EditStudent::class)->name('edit-student');
    Route::get('/student-view/{record}', ViewStudent::class)->name('view-student');
    
    Route::get('/personnels', ListPersonnels::class)->name('personnels');
    Route::get('/personnels/create', CreatePersonnel::class)->name('personnel-create');
    Route::get('/personnels/edit/{record}', EditPersonnel::class)->name('personnel-edit');
    Route::get('/personnels/view/{record}', ViewPersonnel::class)->name('personnel-view');
    
    Route::get('/staffs', ListStaffs::class)->name('staffs');
    Route::get('/staffs/create', CreateStaff::class)->name('staffs-create');
    Route::get('/staffs/edit/{record}', EditStaff::class)->name('staffs-edit');
    Route::get('/staffs/view/{record}', ViewStaff::class)->name('staffs-view');

    Route::get('/emergency-contacts', ListContacts::class)->name('emergency-contacts');
    Route::get('/academic-year', ListAcademicYear::class)->name('academic-year');

    Route::get('/course', ListCourses::class)->name('courses');
    Route::get('/course/create', CreateCourse::class)->name('course-create');
    Route::get('/course/edit/{record}', EditCourse::class)->name('course-edit');

    Route::get('/events', ListEvents::class)->name('events');
    Route::get('/event/create', CreateEvent::class)->name('event-create');
    Route::get('/event/edit/{record}', EditEvent::class)->name('event-edit');
    Route::get('/event/vew/{record}', ViewEvent::class)->name('event-view');
    
    Route::get('/conditions', ListConditions::class)->name('conditions');
    Route::get('/condition/{record}', ManageCondition::class)->name('manage-condition');
    Route::get('/condition/view/{record}', ViewCondition::class)->name('view-condition');
    

    Route::get('/condition/treatments/{record}', ListConditionTreatments::class)->name('condition-treatments-lists');
    Route::get('/condition/treatment/{record}', ViewTreatmentCondition::class)->name('condition-treatment-view');
    Route::get('/condition/symptoms/{record}', ListConditionSymptoms::class)->name('condition-symptoms-list');
    Route::get('/symptoms', ListSymptoms::class)->name('symptoms');

    //FIRT AID GUIDES
    Route::get('/first-aid-guides', ListFirstAidGuides::class)->name('first-aid-guides');
    Route::get('/first-aid-guide/view/{record}', ViewFirstAidGuide::class)->name('first-aid-guide-view');
    Route::get('/first-aid-guide/create', CreateFirstAidGuide::class)->name('first-aid-guide-create');
    Route::get('/first-aid-guide/edit/{record}', CreateFirstAidGuide::class)->name('first-aid-guide-edit');
    
    Route::get('/records', ListRecords::class)->name('records');
    Route::get('/record/create', CreateRecord::class)->name('record-create');
    Route::get('/record/edit/{record}', EditRecord::class)->name('record-edit');
    
    Route::get('/medical-record/user-list/{record}', ListOfUserForIndividualScreening::class)->name('individual-medical-recoding');
    Route::get('/medical-record/create/{record}/{user}', CreateMedicalRecord::class)->name('medical-record-create');
    
    Route::get('/event-announcement-status', EventsAnouncmentSMSStatus::class)->name('event-announcement');

});
