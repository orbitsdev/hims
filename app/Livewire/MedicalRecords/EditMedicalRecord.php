<?php

namespace App\Livewire\MedicalRecords;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\MedicalRecord;
use App\Models\BloodPressureLevel;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Http\Controllers\SendingEmailController;

class EditMedicalRecord extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public MedicalRecord $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::editMedicalForm())
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);
        $this->record->refresh();

        FilamentForm::notification();

        SendingEmailController::sendBPAlertEmail($this->record);

        return redirect()->route('record-list-medical-record', ['record'=> $this->record->record]);
    }

    public function render(): View
    {
        return view('livewire.medical-records.edit-medical-record');
    }
}
