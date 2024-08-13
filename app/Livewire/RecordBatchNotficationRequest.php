<?php

namespace App\Livewire;

use App\Models\RecordBatch;
use Livewire\Component;

class RecordBatchNotficationRequest extends Component
{

    public RecordBatch $record;
    public function render()
    {   
        
        return view('livewire.record-batch-notfication-request');
    }
}
