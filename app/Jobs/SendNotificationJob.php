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
    public function __construct( public User $user, public $data = [])
    {
        $this->user = $user;
        $this->data = $data;

    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {   

        Mail::to('kizzalovelyangelloria@sksu.edu.ph')->send(new AnouncementMail($this->user, $this->data['title'], $this->data['body']));
        // sleep(2);
        // Log::info('Notification sent to user ' . $this->user->id);
    }
}
