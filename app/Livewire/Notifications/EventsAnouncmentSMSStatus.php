<?php

namespace App\Livewire\Notifications;

use App\Models\User;
use Livewire\Component;
use Illuminate\Http\Request;

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

        // Query users based on departments
        // $users = User::departmentBelong($this->departments)->get();
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
