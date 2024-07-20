
<?php

use App\Livewire\Dashboard;
use App\Livewire\User\UserDetails;
use App\Livewire\Users\ListUser;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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
    Route::get('/users', ListUser::class)->name('users');
    Route::get('/user-details/{record}', UserDetails::class)->name('details');
});
