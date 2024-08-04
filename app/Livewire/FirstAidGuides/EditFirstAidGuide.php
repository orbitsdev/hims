<?php

namespace App\Livewire\FirstAidGuides;

use App\Models\FirstAidGuide;
use Filament\Forms;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Form;
use Livewire\Component;
use Illuminate\Contracts\View\View;

class EditFirstAidGuide extends Component implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    public FirstAidGuide $record;

    public function mount(): void
    {
        $this->form->fill($this->record->attributesToArray());
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
            ->model($this->record);
    }

    public function save(): void
    {
        $data = $this->form->getState();

        $this->record->update($data);
    }

    public function render(): View
    {
        return view('livewire.first-aid-guides.edit-first-aid-guide');
    }
}
