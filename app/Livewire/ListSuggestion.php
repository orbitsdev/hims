<?php

namespace App\Livewire;

use Filament\Tables;
use Livewire\Component;
use App\Models\Suggestion;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListSuggestion extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Suggestion::query())
            ->columns([
                Tables\Columns\TextColumn::make('status')
                    ->searchable(),
              
                Tables\Columns\TextColumn::make('suggestion')
                    ->searchable()->wrap(),
                
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    // Action::make('view')
                    // ->color('success')
                    // ->icon('heroicon-m-eye')
                    // ->label('View')
                    // ->modalContent(function (Suggestion $record) {
                    //     return view('livewire.view-blood-preasure-level', ['record' => $record]);
                    // })
                    // ->modalWidth('7xl')
                    // ->modalHeading('Account Details')
                    // ->modalSubmitAction(false)
                    // ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    // ->disabledForm()
                    //  ->slideOver()
                    //  ->closeModalByClickingAway(true),
                    Tables\Actions\EditAction::make()->form(FilamentForm::suggestionForm()) ->modalWidth('7xl'),
                    Tables\Actions\DeleteAction::make(),
                ]),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\BulkActionGroup::make([
                        BulkAction::make('delete')
                            ->requiresConfirmation()
                            ->action(fn (Collection $records) => $records->each->delete())
                    ])
                    ->label('ACTION')
                    ,
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.list-suggestion');
    }
}
