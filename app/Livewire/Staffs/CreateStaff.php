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

class CreateStaff extends Component implements HasForms
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
            ->schema(FilamentForm::staffForm())
            ->statePath('data')
            ->model(Staff::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = Staff::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::notification();
        return redirect()->route('staffs');
    }

    public function render(): View
    {
        return view('livewire.staffs.create-staff');
    }
}