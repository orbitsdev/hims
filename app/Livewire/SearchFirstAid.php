<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Condition;

class SearchFirstAid extends Component
{
    use WithPagination;

    public $searchTerm = '';

    public function updatingSearchTerm()
    {
        // Reset pagination when search term changes
        $this->resetPage();
    }

    public function render()
    {
        $conditions = Condition::query()
            ->where('name', 'like', '%' . $this->searchTerm . '%')
            ->orWhereHas('treatments', function ($query) {
                $query->where('name', 'like', '%' . $this->searchTerm . '%');
            })
            ->orWhereHas('firstAidGuides', function ($query) {
                $query->where('title', 'like', '%' . $this->searchTerm . '%');
            })
            ->with(['treatments', 'firstAidGuides'])
            ->paginate(5); // You can adjust the number of items per page

        return view('livewire.search-first-aid', [
            'conditions' => $conditions,
        ]);
    }
}
