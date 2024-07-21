<?php

namespace App\Livewire\Students;

use Filament\Forms;
use App\Models\User;
use App\Models\Student;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Department;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Group;
use Filament\Forms\Components\Select;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateStudent extends Component implements HasForms
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
            ->schema(FilamentForm::studentForm())
            ->statePath('data')
            ->model(Student::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Student::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::notification();

        return redirect()->route('students');
    }

    public function render(): View
    {
        return view('livewire.students.create-student');
    }
}
