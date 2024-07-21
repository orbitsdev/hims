<?php

namespace App\Livewire\Users;

use App\Http\Controllers\FilamentForm;
use App\Models\User;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateUser extends Component implements HasForms
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
            ->schema(FilamentForm::userForm())
            ->statePath('data')
            ->model(User::class);
    }

    public function create()
    {
        $data = $this->form->getState();

        $record = User::create($data);

        $this->form->model($record)->saveRelationships();
        FilamentForm::notification();
        return redirect()->route('users');

    }

    public function render(): View
    {
        return view('livewire.users.create-user');
    }
}