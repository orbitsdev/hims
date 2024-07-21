<?php

namespace App\Livewire\Personels;

use App\Http\Controllers\FilamentForm;
use App\Models\Personnel;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreatePersonnel extends Component implements HasForms
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
            ->schema(FilamentForm::personnelForm())
            ->statePath('data')
            ->model(Personnel::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Personnel::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::notification();

        return redirect()->route('personnels');
    }

    public function render(): View
    {
        return view('livewire.personels.create-personnel');
    }
}