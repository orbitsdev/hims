<?php

namespace App\Livewire\Events;

use Filament\Forms;
use App\Models\Event;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditEvent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Event $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
             ->schema(FilamentForm::eventForm())
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();
        // $data['user']= Auth::user()->id;
        $this->record->update($data);
        FilamentForm::notification();
        return redirect()->route('events');
    }

    public function render(): View
    {
        return view('livewire.events.edit-event');
    }
}
