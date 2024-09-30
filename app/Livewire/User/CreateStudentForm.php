<?php

namespace App\Livewire\User;

use Filament\Forms;
use App\Models\Student;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateStudentForm extends Component implements HasForms
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
            ->schema(FilamentForm::studentForm2())
            ->statePath('data')
            ->model(Student::class);
    }

    public function create()
    {
        $data = $this->form->getState();
        $data['user_id'] = Auth::user()->id;

        $record = Student::create($data);

        $this->form->model($record)->saveRelationships();
        return redirect()->route('dashboard');

    }

    public function render(): View
    {
        return view('livewire.user.create-student-form');
    }
}
