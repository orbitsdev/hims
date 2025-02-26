<?php

namespace App\Livewire;

use Livewire\Component;

class Reports extends Component
{

    public string $activeTab = 'students';

    public function setTab(string $tab)
    {
        $this->activeTab = $tab;
    }
    public function render()
    {
        return view('livewire.reports');
    }
}
