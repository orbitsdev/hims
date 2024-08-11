<?php

namespace App\Livewire\Records;

use Filament\Forms;
use App\Models\Record;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditRecord extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Record $record;

    public function mount(): void
    {   
        
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
          ->schema(FilamentForm::recordForm())

            ->statePath('data')
            ->model($this->record);


    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);
        FilamentForm::notification();
        return redirect()->route('records');
    }

    public function render(): View
    {
        return view('livewire.records.edit-record');
    }
}
