
<?php

use App\Livewire\Dashboard;
use App\Livewire\EventList;
use App\Livewire\QueueMonitor;
use App\Livewire\RoleSelection;
use App\Livewire\AdminDashboard;
use App\Livewire\ListSuggestion;
use App\Livewire\SearchFirstAid;
use App\Livewire\StaffDashboard;
use App\Livewire\Users\EditUser;
use App\Livewire\Users\ListUser;
use App\Livewire\Events\EditEvent;
use App\Livewire\Events\ViewEvent;
use App\Livewire\Staffs\EditStaff;
use App\Livewire\Staffs\ViewStaff;
use App\Livewire\StudentDashboard;
use App\Livewire\User\UserDetails;
use App\Livewire\Users\CreateUser;
use App\Livewire\Events\ListEvents;
use App\Livewire\MonitorSendSmsJob;
use App\Livewire\Staffs\ListStaffs;
use App\Livewire\Usesr\EditProfile;
use App\Livewire\Courses\EditCourse;
use App\Livewire\Events\CreateEvent;
use App\Livewire\Records\EditRecord;
use App\Livewire\Staffs\CreateStaff;
use App\Livewire\UserMedicalRecords;
use Illuminate\Support\Facades\Auth;
use App\Livewire\Courses\ListCourses;
use App\Livewire\FirstAidDetailsPage;
use App\Livewire\Records\ListBatches;
use App\Livewire\Records\ListRecords;
use Illuminate\Support\Facades\Route;
use App\Livewire\Courses\CreateCourse;
use App\Livewire\MedicalRecordDetails;
use App\Livewire\Records\CreateRecord;
use App\Livewire\Students\EditStudent;
use App\Livewire\Students\ViewStudent;
use App\Livewire\ViewSendNotification;
use App\Livewire\Sections\ListSections;
use App\Livewire\Students\ListStudents;
use App\Livewire\Symptoms\ListSymptoms;
use Filament\Tables\Actions\EditAction;
use App\Livewire\Emergency\ListContacts;
use App\Livewire\ListBloodPressureLevel;
use App\Livewire\PublicEmergencyContact;
use App\Livewire\Students\CreateStudent;
use App\Livewire\User\CreateStudentForm;
use Laravel\Socialite\Facades\Socialite;
use App\Livewire\Personels\EditPersonnel;
use App\Http\Controllers\ReportController;
use App\Livewire\Conditions\EditCondition;
use App\Livewire\Conditions\ListCondtions;
use App\Livewire\Conditions\ViewCondition;
use App\Livewire\Personnels\ViewPersonnel;
use App\Livewire\User\CreatePersonnelForm;
use App\Livewire\Conditions\ListConditions;
use App\Livewire\Personels\CreatePersonnel;
use App\Livewire\Personnels\ListPersonnels;
use App\Livewire\Records\ListMedicalRecord;
use App\Livewire\Conditions\ManageCondition;
use App\Livewire\Records\ListOfUsersByBatch;
use App\Livewire\Conditions\ManageConditions;
use App\Livewire\Departments\ListDepartments;
use App\Livewire\User\FillStudentInformation;
use App\Livewire\AcademicYear\ListAcademicYear;
use App\Livewire\RecordBatchNotficationRequest;
use App\Http\Controllers\GoogleCallbackController;
use App\Livewire\Condition\ViewTreatmentCondition;
use App\Livewire\Conditions\ListConditionSymptoms;
use App\Livewire\FirstAidFuides\ViewFirstAidGuide;
use App\Livewire\FirstAidGuides\ListFirstAidGuide;
use App\Livewire\MedicalRecords\EditMedicalRecord;
use App\Livewire\Conditions\CondtionTreatmentLists;
use App\Livewire\FirstAidGuides\ListFirstAidGuides;
use App\Livewire\Conditions\ListConditionTreatments;
use App\Livewire\FirstAidGuides\CreateFirstAidGuide;
use App\Livewire\MedicalRecords\CreateMedicalRecord;
use App\Livewire\Records\CreateMedicalRecordByBatch;
use App\Livewire\Notifications\EventsAnouncmentSMSStatus;
use App\Livewire\Records\ListOfUserForIndividualScreening;

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

Route::get('/shop', function () {

    return view('shop');
});

Route::get('/test', function () {

    return view('notifications.index');
});


Route::get('/', function () {

    return redirect()->route('dashboard');
});

Route::get('/auth/google', [GoogleCallbackController::class,'redirect'])->middleware('guest')->name('auth.google.redirect');
Route::get('/auth/google/callback', [GoogleCallbackController::class,'callBack'])->middleware('guest')->name('auth.google.callBack');

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified',
])->group(function () {

    Route::get('/dashboard', function () {

        if(Auth::user()->role == null){
            return redirect()->route('role.selection');
        }else{

            return Auth::user()->dashBoardBaseOnRole();
        }

    })->name('dashboard');

    Route::get('/student-create-form', CreateStudentForm::class)->name('fill.student-form')->middleware(['can:student-no-account']);
    Route::get('/personnel-create-form', CreatePersonnelForm::class)->name('fill.personnel-form')->middleware(['can:personnel-no-account']);





    Route::get('/role-selection', RoleSelection::class)->name('role.selection')->middleware(['can:no-role']);

    Route::get('/unauthorizepage', function () { return 'UnAuthorize'; })->name('unauthorizepage');

    Route::get('/admin-dashboard', AdminDashboard::class)->name('admin-dashboard');
    Route::get('/student-dashboard', StudentDashboard::class)->name('student-dashboard');
    Route::get('/staff-dashboard', StaffDashboard::class)->name('staff-dashboard');
    Route::get('/user/edit/{record}', EditProfile::class)->name('edit-profile');
    Route::middleware('can:admin-and-staff')->group(function () {
        Route::get('/users', ListUser::class)->name('users');
      
        // Route::get('/user/edit/{record}', EditProfile::class)->name('edit-profile');
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

        Route::get('/emergency-contacts', ListContacts::class)->name('emergency-contacts');
        Route::get('/academic-year', ListAcademicYear::class)->name('academic-year');

        Route::get('/course', ListCourses::class)->name('courses');
        Route::get('/course/create', CreateCourse::class)->name('course-create');
        Route::get('/course/edit/{record}', EditCourse::class)->name('course-edit');

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

        Route::get('/blood-pressure-levels', ListBloodPressureLevel::class)->name('blood-pressure-levels');
        Route::get('/suggestions', ListSuggestion::class)->name('suggestions');

        Route::get('/records', ListRecords::class)->name('records');
        Route::get('/record/create', CreateRecord::class)->name('record-create');
        Route::get('/record/edit/{record}', EditRecord::class)->name('record-edit');

        Route::get('/record/collection/medical-record/{record}', ListMedicalRecord::class)->name('record-list-medical-record');
        Route::get('/record/collection/medical-record/edit/{record}', EditMedicalRecord::class)->name('medical-record-edit');


        Route::get('/medical-record/user-list/{record}', ListOfUserForIndividualScreening::class)->name('individual-medical-recoding');
        Route::get('/medical-record/list-batch/{record}', ListBatches::class)->name('batches');
        Route::get('/medical-record/list-batch/request/{record}', RecordBatchNotficationRequest::class)->name('batches-request-notification');
        Route::get('/medical-record/user-list-by-batch/{record}', ListOfUsersByBatch::class)->name('by-batch-medical-recoding');

        Route::get('/medical-record/create/{record}/{user}', CreateMedicalRecord::class)->name('medical-record-create');
        Route::get('/medical-record/by-batch/create/{record}/{user}', CreateMedicalRecordByBatch::class)->name('medical-record-create-by-batch');
    });

    // SYSTEM SUERS





    Route::middleware(['can:admin'])->group(function () {

        Route::get('/staffs', ListStaffs::class)->name('staffs');
        Route::get('/staffs/create', CreateStaff::class)->name('staffs-create');
        Route::get('/staffs/edit/{record}', EditStaff::class)->name('staffs-edit');
        Route::get('/staffs/view/{record}', ViewStaff::class)->name('staffs-view');
        Route::get('/events', ListEvents::class)->name('events');

        Route::get('/event/create', CreateEvent::class)->name('event-create');
        Route::get('/event/edit/{record}', EditEvent::class)->name('event-edit');
        Route::get('/event/vew/{record}', ViewEvent::class)->name('event-view');
    });





    //
    Route::get('/sections', ListSections::class)->name('sections');

    Route::get('/monitor-sms', MonitorSendSmsJob::class)->name('monitor-sms');
    Route::get('/view-notification-sent/{record}', ViewSendNotification::class)->name('vew-notification-sent');

    Route::get('/test-report', function () {
        return view('reports.medical-report');
    });
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('medical-report/view/{record}', [ReportController::class, 'viewMedicalReport'])->name('view-medical-record');
    });
    Route::prefix('reports')->name('reports.')->group(function () {
        Route::get('medical-report/{record}', [ReportController::class, 'generatePdf'])->name('medical-record');
    });

    Route::get('/students/export', [ReportController::class, 'exportStudents'])->name('students.export');
    Route::get('/staff/export', [ReportController::class, 'exportStaff'])->name('staff.export');
    Route::get('/events/export', [ReportController::class, 'exportEvents'])->name('events.export');
    Route::get('/personnels/export', [ReportController::class, 'exportPersonnels'])->name('personnels.export');
    Route::get('/emergency-contacts/export', [ReportController::class, 'exportEmergencyContacts'])->name('emergency-contacts.export');

    Route::get('first-aid-guide/{record}', [ReportController::class, 'generateFirstAidPdf'])->name('first-aid-guide.pdf');


    Route::middleware(['can:student-and-personnel'])->group(function () {
        Route::get('/public/events', EventList::class)->name('events.index');
        Route::get('/public/first-aid-search', SearchFirstAid::class)->name('first-aid.search');
        Route::get('/public/first-aid-details/{id}', FirstAidDetailsPage::class)->name('first-aid.details');
        Route::get('/public/medical-records', UserMedicalRecords::class)->name('user.medical-records');
        Route::get('/public/medical-records/{id}', MedicalRecordDetails::class)->name('medical-record-details');
        Route::get('/public/emergency-contacts', PublicEmergencyContact::class)->name('public.emergency-contacts');
    });
});
