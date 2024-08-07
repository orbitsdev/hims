<?php

namespace App\Livewire\Notifications;

use App\Mail\AnouncementMail;
use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\FilamentForm;
use App\Notifications\SmsNotification;
use App\Notifications\AnouncementNotification;

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

        // Mail::to('programmingacount@gmail.com')->send(new AnouncementMail($users[0]));
        // foreach ($users as $user) {
           
        //     Mail::to('programmingacount@gmail.com')->send(new AnouncementMail($user));
        //     // $user->notify(new AnouncementNotification());
        //     //$user->notify(new SmsNotification($hardcodedPhoneNumber, $user->name));
        // }

        

        FilamentForm::notification('messae');
       
       
    }

            public function render()
    {
        return view('livewire.notifications.events-anouncment-s-m-s-status');
    }
}
