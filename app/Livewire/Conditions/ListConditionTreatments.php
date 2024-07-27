<?php

namespace App\Livewire\Conditions;

use Filament\Tables;
use Livewire\Component;
use App\Models\Condition;
use App\Models\Treatment;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListConditionTreatments extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Condition $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(Treatment::query()->latest()->where('condition_id', $this->record->id))
            ->columns([
               
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
              
            ])
            ->filters([
                //
            ])
            ->actions([
            Action::make('viewTreatment')
            ->color('success')
            ->label('View')
            ->size('xl')
            ->icon(null)
            ->link()
          
            ->extraAttributes([
                'class' => 'border: none !imporant',
            ])
            ->modalContent(function (Model $record) {
                return view('livewire.condition.view-treatment-condition', ['record' => $record]);
            })
            ->modalHeading('Account Details')
            ->modalSubmitAction(false)
            ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
            ->disabledForm()
             ->slideOver()
             ->closeModalByClickingAway(true)
       
            ->modalWidth(MaxWidth::Full),
                Tables\Actions\EditAction::make()->form(FilamentForm::treatmentForm()),
                Tables\Actions\DeleteAction::make(),
   
            ])
            ->bulkActions([

                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete())
                ])
                ->label('ACTION')
                ,
               
            ]);
    }

    public function render(): View
    {
        return view('livewire.conditions.list-condition-treatments');
    }
}
