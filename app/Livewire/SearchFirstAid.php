<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\Condition;

class SearchFirstAid extends Component
{
    public $searchTerm = '';

    // Using correct lifecycle hook in Livewire 3
    // public function updatingSearchTerm($value) {
    //     // This will fire whenever the searchTerm is updated
    //     dd('searchTerm is updating');
    // }

    public function render()
    {
        $conditions = Condition::query()
   
    ->whereHas('treatments')
    ->whereHas('firstAidGuides')
    
    ->where('name', 'like', '%' . $this->searchTerm . '%')
   
    ->orWhereHas('treatments', function ($query) {
        $query->where('name', 'like', '%' . $this->searchTerm . '%');
    })
   
    ->orWhereHas('firstAidGuides', function ($query) {
        $query->where('title', 'like', '%' . $this->searchTerm . '%');
    })

    ->with(['treatments', 'firstAidGuides'])
    ->get();

return view('livewire.search-first-aid', [
    'conditions' => $conditions,
]);
    }
}
