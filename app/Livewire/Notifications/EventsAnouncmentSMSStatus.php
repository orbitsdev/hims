<?php

namespace App\Livewire\Notifications;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use App\Http\Controllers\FilamentForm;
use App\Notifications\SmsNotification;

class EventsAnouncmentSMSStatus extends Component {

    public $title;
    public $body;
    public $departments = [];
    public function mount(Request $request)
    {
        // Access the request data
        $this->title = $request->input('title');
        $this->body = $request->input('body');
        $this->departments = json_decode($request->input('departments', '[]'), true);
          $hardcodedPhoneNumber = '+639366303145';

        $users = User::departmentBelong($this->departments)->get();
        
        // Loop through users and send notification to the hardcoded phone number
        foreach ($users as $user) {
            $user->notify(new SmsNotification($hardcodedPhoneNumber, $user->name));
        }

        // Query users based on departments
        // $users = User::departmentBelong($this->departments)->get();
        // foreach ($users as $user) {
        //     $user->notify(new SmsNotification($user->phone_number, $this->message));
        // }

        FilamentForm::notification('messae');
       // return redirect()->route('queue-monitor');
        // $names  = [];
        // foreach ($users as $user) {
        //     $names[] = $user->name;
        // }
        // dd(['LIST OF USERS TO BE NOTIFIED UNDER SELECTED DEPARTMENT' => $names]);
       
    }

            public function render()
    {
        return view('livewire.notifications.events-anouncment-s-m-s-status');
    }
}
