
<?php

use App\Livewire\AcademicYear\ListAcademicYear;
use App\Livewire\Dashboard;
use App\Livewire\Events\ListEvents;
use App\Livewire\Users\EditUser;
use App\Livewire\Users\ListUser;
use App\Livewire\Staffs\EditStaff;
use App\Livewire\Staffs\ViewStaff;
use App\Livewire\User\UserDetails;
use App\Livewire\Users\CreateUser;
use App\Livewire\Staffs\ListStaffs;
use App\Livewire\Staffs\CreateStaff;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Livewire\Students\EditStudent;
use App\Livewire\Students\ViewStudent;
use App\Livewire\Students\ListStudents;
use App\Livewire\Students\CreateStudent;
use App\Livewire\Personels\EditPersonnel;
use App\Livewire\Personnels\ViewPersonnel;
use App\Livewire\Personels\CreatePersonnel;
use App\Livewire\Personnels\ListPersonnels;
use App\Livewire\Departments\ListDepartments;
use App\Livewire\Emergency\ListContacts;
use App\Livewire\Events\CreateEvent;
use App\Livewire\Events\EditEvent;
use App\Livewire\Events\ViewEvent;
use App\Livewire\Usesr\EditProfile;

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
    Route::get('/events', ListEvents::class)->name('events');
    Route::get('/event/create', CreateEvent::class)->name('event-create');
    Route::get('/event/edit/{record}', EditEvent::class)->name('event-edit');
    Route::get('/event/vew/{record}', ViewEvent::class)->name('event-view');
    


});
