<?php

namespace App\Livewire\Courses;

use App\Http\Controllers\FilamentForm;
use App\Models\Course;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditCourse extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public Course $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::courseForm())
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();
        $this->record->update($data);
        FilamentForm::notification();

        return redirect()->route('courses');
    }

    public function render(): View
    {
        return view('livewire.courses.edit-course');
    }
}
