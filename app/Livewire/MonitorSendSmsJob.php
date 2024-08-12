<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;

class MonitorSendSmsJob extends Component
{
    public function render()
    {

        $pendingJobs = DB::table('jobs')->get();
        $failedJobs = DB::table('failed_jobs')->get();
        
        return view('livewire.monitor-send-sms-job',[
           'pendingJobs'=> $pendingJobs,
           'failedJobs'=> $failedJobs,
        ]);
    }
}
