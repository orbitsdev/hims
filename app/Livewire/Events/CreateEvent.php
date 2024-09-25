<?php

namespace App\Livewire\Events;

use Filament\Forms;
use App\Models\Event;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateEvent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public function mount(): void
    {
        $this->form->fill();
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::eventForm())
            ->statePath('data')
            ->model(Event::class);
    }

    public function create()
    {
        $data = $this->form->getState();
        $data['user_id']= Auth::user()->id;

        $record = Event::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::notification();
        return redirect()->route('events');

    }

    public function render(): View
    {
        return view('livewire.events.create-event');
    }
}