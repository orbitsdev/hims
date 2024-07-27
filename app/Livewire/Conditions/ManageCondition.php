<?php

namespace App\Livewire\Conditions;

use Filament\Forms;
use Livewire\Component;
use Filament\Forms\Form;
use App\Models\Condition;
use App\Models\Treatment;
use Filament\Actions\Action;
use Filament\Actions\EditAction;
use Filament\Actions\CreateAction;
use Filament\Actions\StaticAction;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Support\Enums\Alignment;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Actions\Contracts\HasActions;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Actions\Concerns\InteractsWithActions;

class ManageCondition extends Component implements HasForms, HasActions
{
    use InteractsWithForms;
    use InteractsWithActions;

    public ?array $data = [];

    public Condition $record;

    public function mount(): void
    {   
       

        $this->form->fill($this->record->attributesToArray());
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema(FilamentForm::conditionForm())->columns(3)
            ->statePath('data')
            ->model($this->record);
    }

    public function save()
    {
        $data = $this->form->getState();

        $this->record->update($data);
        
        FilamentForm::notification();
        return redirect()->route('conditions');
    }

    public function render(): View
    {

        $this->record->load(['treatments'=> function($query){
            return $query->latest()->take(5);
        }]);
        return view('livewire.conditions.manage-condition',['record'=> $this->record]);
    }


    public function createTreatmentAction(): CreateAction
    {
        return CreateAction::make('createTreatment')
        ->label('New Treatment')
        ->size('lg')
        
        ->icon(null)
     
        ->extraAttributes(['style' => 'border: 0px transparent'])
        ->model(Treatment::class)
        ->modalWidth(MaxWidth::SevenExtraLarge)
        ->mutateFormDataUsing(function (array $data): array {
            $data['condition_id'] = $this->record->id;
     
            return $data;
        })
        
        ->createAnother(false)
        ->form(FilamentForm::treatmentForm());
        
    }
    public function editTreatmentAction(): EditAction
    {
        return EditAction::make('editTreatment')
        ->label('Edit')

        ->icon('heroicon-m-pencil-square')
        ->fillForm(function(array $arguments){
            $selected = Treatment::find($arguments['record']);
            return [
                'name'=> $selected->name,
                'description'=> $selected->description,
            ];
        })

        ->size('lg')
        ->iconButton()
        

        ->record(fn (array $arguments) => Treatment::find($arguments['record']))
        ->modalWidth(MaxWidth::SevenExtraLarge)
        // ->mutateFormDataUsing(function (array $data, array $arguments): array {
        //     $data['condition_id'] = $this->record->id;
     
        //     return $data;
        // })
        ->form(FilamentForm::treatmentForm());
        
    }

    public function deleteTreatmentAction(): Action
    {
        return Action::make('deleteTreatment')
        ->icon('heroicon-o-x-mark')
        ->color('danger')
            ->requiresConfirmation()
            ->size('xl')
            ->iconButton()
            ->action(function (array $arguments) {

                $selected = Treatment::find($arguments['record']);
                $selected->delete();
                FilamentForm::notification('Treatment Deleted');
            });
    }
    public function viewTreatmentAction(): Action
    {
        return Action::make('viewTreatment')
            ->color('success')
            ->label('View')
            ->size('xl')
            ->icon(null)
            ->link()
          
            ->extraAttributes([
                'class' => 'border: none !imporant',
            ])
            ->modalContent(function (array $arguments) {
                return view('livewire.condition.view-treatment-condition', ['record' => Treatment::find($arguments['record'])]);
            })
            ->modalHeading('Account Details')
            ->modalSubmitAction(false)
            ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
            ->disabledForm()
             ->slideOver()
             ->closeModalByClickingAway(true)
       
            ->modalWidth(MaxWidth::Full);
            
    }
}
