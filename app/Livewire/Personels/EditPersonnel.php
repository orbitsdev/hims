<?php

namespace App\Livewire\Personels;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Personnel;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class EditPersonnel extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Personnel $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::personnelForm())
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);
        FilamentForm::notification();

        return redirect()->route('personnels');
        
    }

    public function render(): View
    {
        return view('livewire.personels.edit-personnel');
    }
}
