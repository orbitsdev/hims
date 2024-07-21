<?php

namespace App\Livewire\Staffs;

use App\Http\Controllers\FilamentForm;
use App\Models\Staff;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditStaff extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Staff $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::staffForm())
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);
        FilamentForm::notification();
        return redirect()->route('staffs');
    }

    public function render(): View
    {
        return view('livewire.staffs.edit-staff');
    }
}
