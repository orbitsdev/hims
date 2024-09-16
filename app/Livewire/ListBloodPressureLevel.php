<?php

namespace App\Livewire;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\BloodPressureLevel;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListBloodPressureLevel extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(BloodPressureLevel::query())
            ->columns([
                Tables\Columns\TextColumn::make('level_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('systolic_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('systolic_max')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('diastolic_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('diastolic_max')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('age_min')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('age_max')
                    ->numeric()
                    ->sortable(),
                
            ])

            ->headerActions([

                CreateAction::make()->form
                (FilamentForm::bloodPressureLevelForm())->label('New')->size('lg')
                ->icon('heroicon-s-sparkles')
                ->createAnother(false)
                ->modalWidth('7xl')
              
            ])
            ->filters([
                //
            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')
                    ->color('success')
                    ->icon('heroicon-m-eye')
                    ->label('View')
                    ->modalContent(function (BloodPressureLevel $record) {
                        return view('livewire.view-blood-preasure-level', ['record' => $record]);
                    })
                    ->modalWidth('7xl')
                    ->modalHeading('Account Details')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->disabledForm()
                     ->slideOver()
                     ->closeModalByClickingAway(true),
                    Tables\Actions\EditAction::make()->form(FilamentForm::bloodPressureLevelForm()) ->modalWidth('7xl'),
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
        return view('livewire.list-blood-pressure-level');
    }
}
