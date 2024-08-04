<?php

namespace App\Livewire\Events;

use Filament\Tables;
use App\Models\Event;
use Livewire\Component;
use App\Models\Department;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Collection;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\RichEditor;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
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
                Tables\Columns\TextColumn::make('title')->searchable()->label('TITLE'),
                Tables\Columns\TextColumn::make('academicYear.name')->searchable()->label('ACADEMIC YEAR'),
                Tables\Columns\TextColumn::make('semester')->formatStateUsing(function(Model $record){
                    return $record->semester->semesterWithYear();
                })->searchable()->label('SEMESTER'),
                    // ->numeric()
                Tables\Columns\TextColumn::make('event_date')
                    ->date()->label('EVENT DATE'),
                // Tables\Columns\TextColumn::make('event_date_time')
                //     ->date()
                //     ->sortable(),
                // Tables\Columns\IconColumn::make('is_published')
                //     ->boolean()->label('IS PUBLISHED'),

                    ToggleColumn::make('is_published')->label('IS PUBLISHED')
   
    ->afterStateUpdated(function ($record, $state) {
          FilamentForm::notification($record->title.''. ($state ? 'Event was Published' : 'Event was Unpublished'));

    })
              
            ])
            ->filters([
                SelectFilter::make('ACADEMIC YEAR')
                ->label('ACADEMIC YEAR')
                ->relationship('academicYear', 'name')
                ->searchable()
                ->preload()
                ,

                // SelectFilter::make('SEMESTER')
                // ->label('SEMESTER')
                // ->relationship('semester', 'name_in_text')
                // ->searchable()
                // ->preload()
            ],layout: FiltersLayout::AboveContent)
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
                Action::make('sendEmail')
                ->label('SEND NOTIFICATIONS')
                ->icon('heroicon-m-bell-alert')
                ->size('lg')
    ->form([
        TextInput::make('Title')->required(),
        RichEditor::make('body')->required(),
        Select::make('department_id')
        ->preload()
        ->native(false)
                            ->required()
                            ->label('BUILDING/DEPARTMENT')
                            ->options(Department::get()->map(function ($d) {
                                return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                            })->pluck('name', 'id'))
                            ->searchable()
       
    ])
    ->button()
    ->action(function (array $data) {
            // dd($data);
        FilamentForm::notification('NOTIFICATION FEATURES COMING SOON ');
        // Mail::to($this->client)
        //     ->send(new GenericEmail(
        //         subject: $data['subject'],
        //         body: $data['body'],
        //     ));
    }),
                ActionGroup::make([
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
                ]),
               
                
              
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
