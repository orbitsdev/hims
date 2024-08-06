<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class QueueMonitor extends Component
{
    public $jobs;
    public $failedJobs;

    public function mount()
    {
        $this->loadJobs();
    }

    public function loadJobs()
    {
        $this->jobs = DB::table('jobs')->get();
        $this->failedJobs = DB::table('failed_jobs')->get();
    }

    // public function retryJob($id)
    // {
    //     $failedJob = DB::table('failed_jobs')->find($id);

    //     if ($failedJob) {
    //         $payload = json_decode($failedJob->payload, true);

    //         try {
    //             // Dispatch the job back to the queue
    //             dispatch(new \Illuminate\Bus\QueueableJob($payload['data']['command']));

    //             // Remove the failed job from the failed_jobs table
    //             DB::table('failed_jobs')->where('id', $id)->delete();
                
    //             // Reload jobs to reflect the changes
    //             $this->loadJobs();

    //             session()->flash('success', 'Job retried successfully!');
    //         } catch (\Exception $e) {
    //             // Log any errors encountered while retrying the job
    //             Log::error('Failed to retry job: ' . $e->getMessage());
    //             session()->flash('error', 'Failed to retry job.');
    //         }
    //     }
    // }
    public function render()
    {
        return view('livewire.queue-monitor');
    }
}
