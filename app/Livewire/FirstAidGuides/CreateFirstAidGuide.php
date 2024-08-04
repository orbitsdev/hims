<?php

namespace App\Livewire\FirstAidGuides;

use App\Models\FirstAidGuide;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class CreateFirstAidGuide extends Component implements HasForms
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
            ->schema([
                Forms\Components\TextInput::make('condition_id')
                    ->numeric(),
                Forms\Components\TextInput::make('title')
                    ->maxLength(191),
                Forms\Components\Textarea::make('content')
                    ->columnSpanFull(),
            ])
            ->statePath('data')
            ->model(FirstAidGuide::class);
    }

    public function create(): void
    {
        $data = $this->form->getState();

        $record = FirstAidGuide::create($data);

        $this->form->model($record)->saveRelationships();
    }

    public function render(): View
    {
        return view('livewire.first-aid-guides.create-first-aid-guide');
    }
}