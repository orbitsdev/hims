<?php

namespace App\Livewire\Records;

use Filament\Tables;
use App\Models\Record;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\CreateAction;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\CreateAction as TAction;

class ListRecords extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Record::query())
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable()->label('TITLE'),
                Tables\Columns\TextColumn::make('academicYear.name')->searchable()->label('ACADEMIC YEAR'),
                Tables\Columns\TextColumn::make('semester')->formatStateUsing(function(Model $record){
                    return $record->semester->semesterWithYear();
                })->searchable()->label('SEMESTER'),

                ToggleColumn::make('status')
               
                ->afterStateUpdated(function ($record, $state) {
                    FilamentForm::notification('Status Was set to '. $state ? 'Active' : 'Inactive');
                })

                // TextColumn::make('recordBatches')->counts('recordBatches')->label('BATCH COUNT')
    //             TextColumn::make('recordBatches.description')->label('BATCH')
    // ->listWithLineBreaks()
    // ->limitList(3)
    // ->expandableLimitedList()

                // Tables\Columns\TextColumn::make('academic_year_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('semester_name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                TAction::make('create')
                ->size('lg')
                ->color('primary')
                ->label('New')
                ->modalHeading('CREATE RECORD')
                ->icon('heroicon-s-plus')
                ->modalWidth(MaxWidth::SevenExtraLarge)
                ->createAnother(false)
                // ->form(FilamentForm::recordForm())
                
               
                ->url(function(){
                    return route('record-create');
                }),
            ])
            ->actions([
                // Action::make('view')
                // ->color('success')
                // ->icon('heroicon-m-eye')
                // ->label('View')
                // ->modalContent(function (Student $record) {
                //     return view('livewire.students.view-student', ['record' => $record]);
                // })
                // ->modalHeading('Details')
                // ->modalSubmitAction(false)
                // ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                // ->disabledForm()
                //  ->slideOver()
                //  ->closeModalByClickingAway(true)
                
                // ->modalWidth(MaxWidth::Full),
                //  Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function(Model $record){
                //             return route('edit-student', ['record'=> $record]);
                //   }),
                Tables\Actions\DeleteAction::make(),
                
              
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete())
                ])
                ->label('ACTION')
                ,            ]);
    }

    public function render(): View
    {
        return view('livewire.records.list-records');
    }
}
