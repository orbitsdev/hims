<?php

namespace App\Livewire\User;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Personnel;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Concerns\InteractsWithForms;

class CreatePersonnelForm extends Component implements HasForms
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
            ->schema(FilamentForm::personnelForm2())
            ->statePath('data')
            ->model(Personnel::class);
    }

    public function create()
    {
        $data = $this->form->getState();
        $data['user_id'] = Auth::user()->id;


        $record = Personnel::create($data);

        $this->form->model($record)->saveRelationships();
          return redirect()->route('dashboard');
    }

    public function render(): View
    {
        return view('livewire.user.create-personnel-form');
    }
}
