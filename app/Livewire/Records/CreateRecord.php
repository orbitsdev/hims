<?php

namespace App\Livewire\Records;

use App\Http\Controllers\FilamentForm;
use App\Models\Record;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateRecord extends Component implements HasForms
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
            ->schema(FilamentForm::recordForm())
            ->statePath('data')
            ->model(Record::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Record::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::notification();
        return redirect()->route('records');
    }

    public function render(): View
    {
        return view('livewire.records.create-record');
    }
}