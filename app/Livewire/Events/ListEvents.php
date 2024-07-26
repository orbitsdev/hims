<?php

namespace App\Livewire\Events;

use App\Http\Controllers\FilamentForm;
use Filament\Tables;
use App\Models\Event;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Collection;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListEvents extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Event::query())
            ->columns([
                Tables\Columns\TextColumn::make('title')->searchable(),
                Tables\Columns\TextColumn::make('academicYear.name')->searchable(),
                Tables\Columns\TextColumn::make('semester')->formatStateUsing(function(Model $record){
                    return $record->semester->semesterWithYear();
                })->searchable(),
                    // ->numeric()
                Tables\Columns\TextColumn::make('event_date')
                    ->date(),
                // Tables\Columns\TextColumn::make('event_date_time')
                //     ->date()
                //     ->sortable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean(),

                    ToggleColumn::make('is_published')
   
    ->afterStateUpdated(function ($record, $state) {
          FilamentForm::notification($record->title.''. ($state ? 'Event was Published' : 'Event was Unpublished'));

    })
              
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('view')
                ->size('lg')
                ->color('primary')
                
                ->label('New Event')
                ->icon('heroicon-s-plus')
               
                ->url(function(){
                    return route('event-create');
                }),
            ])
            ->actions([
                Action::make('view')
                ->color('success')
                ->icon('heroicon-m-eye')
                ->label('View')
                ->modalContent(function (Event $record) {
                    return view('livewire.events.view-event', ['record' => $record]);
                })
                ->modalHeading('Details')
                ->modalSubmitAction(false)
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                ->disabledForm()
                 ->slideOver()
                 ->closeModalByClickingAway(true)
                
                ->modalWidth(MaxWidth::Full),
                 Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function(Model $record){
                            return route('event-edit', ['record'=> $record]);
             }),
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
        return view('livewire.events.list-events');
    }
}
