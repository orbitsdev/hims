<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PersonalDetail extends Component
{

    public $record;

    /**
     * Create a new component instance.
     */
    public function __construct($record = null)
    {
        $this->record = $record;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.personal-detail');
    }
}
