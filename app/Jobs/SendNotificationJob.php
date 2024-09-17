<?php

namespace App\Jobs;

use App\Models\User;
use App\Models\RecordBatch;
use App\Mail\AnouncementMail;
use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

class SendNotificationJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;



    /**
     * Create a new job instance.
     */
    public function __construct( public  $users = [], public $data = [])
    {
        $this->users = $users;
        $this->data = $data;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {


        foreach($this->users as $user){
           Log::info('Notification sent to user ' . $user->id);

            Mail::to($user->email)->send(new AnouncementMail($user,  $this->data['message']));
        }
            // sleep(2);

    }
}
