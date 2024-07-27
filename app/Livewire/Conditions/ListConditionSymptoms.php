<?php

namespace App\Livewire\Conditions;

use Filament\Tables;
use App\Models\Symptom;
use Livewire\Component;
use App\Models\Condition;
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
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListConditionSymptoms extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Condition $record;
    public function table(Table $table): Table
    {
        return $table   
        
            ->query(Symptom::query()->whereHas('conditions', function($query){$query->where('condition_id',$this->record->id);}))
            ->columns([
                ImageColumn::make('file.file')
                ->disk('public')
                ->label('Profile')
                ->width(60)->height(60)
                ->url(fn (Model $record): null|string => $record->file ?  Storage::disk('public')->url($record->file) : null)
                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
             
            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('viewSymptom')
                ->color('success')
                ->label('View')
                ->size('xl')
                ->icon(null)
                ->link()
              
                ->extraAttributes([
                    'class' => 'border: none !imporant',
                ])
                ->modalContent(function (Model $record) {
                    return view('livewire.conditions.view-condition-symtom', ['record' => $record]);
                })
                ->modalSubmitAction(false)
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                ->disabledForm()
                 ->slideOver()
                 ->closeModalByClickingAway(true)
           
                ->modalWidth(MaxWidth::Full),
                    Tables\Actions\EditAction::make()->form(FilamentForm::symptomForm()),
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
        return view('livewire.conditions.list-condition-symptoms');
    }
}
