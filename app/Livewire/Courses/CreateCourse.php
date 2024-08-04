<?php

namespace App\Livewire\Courses;

use Filament\Forms;
use App\Models\Course;
use Livewire\Component;
use Filament\Forms\Form;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreateCourse extends Component implements HasForms
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
        ->schema(FilamentForm::courseForm())
            ->statePath('data')
            ->model(Course::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Course::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::notification();

        return redirect()->route('courses');
    }

    public function render(): View
    {
        return view('livewire.courses.create-course');
    }
}