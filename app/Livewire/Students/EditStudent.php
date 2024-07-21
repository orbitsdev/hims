<?php

namespace App\Livewire\Students;

use Filament\Forms;
use App\Models\User;
use App\Models\Student;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class EditStudent extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Student $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::studentForm())
            ->statePath('data')
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.students.edit-student');
    }
}
