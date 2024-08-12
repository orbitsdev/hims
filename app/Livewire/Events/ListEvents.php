<?php

namespace App\Livewire\Events;

use App\Models\User;
use Filament\Tables;
use App\Models\Event;
use Livewire\Component;
use App\Models\Department;
use Filament\Tables\Table;
use App\Mail\AnouncementMail;
use App\Jobs\SendNotificationJob;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Mail;
use Filament\Forms\Components\Select;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Notifications\Collection;
use Filament\Forms\Components\Textarea;
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
use Filament\Forms\Components\CheckboxList;
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
                Tables\Columns\TextColumn::make('semester')->formatStateUsing(function (Model $record) {
                    return $record->semester->semesterWithYear();
                })->label('SEMESTER')
                    ->searchable(query: function (Builder $query, string $search): Builder {
                        return $query->whereHas('semester', function ($query) use ($search) {
                            $query->where('name_in_text', 'like', "%{$search}%")
                                ->orWhere('name_in_number', 'like', "%{$search}%");
                        });
                    }),
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
                        FilamentForm::notification($record->title . '' . ($state ? 'Event was Published' : 'Event was Unpublished'));
                    })

            ])
            ->filters([

                SelectFilter::make('ACADEMIC YEAR')
                    ->label('ACADEMIC YEAR')
                    ->relationship('academicYear', 'name',fn (Builder $query) => $query->hasEvents())
                    ->searchable()
                    ->preload(),

                // SelectFilter::make('SEMESTER')
                // ->label('SEMESTER')
                // ->relationship('semester', 'name_in_text')
                // ->searchable()
                // ->preload()
            ], layout: FiltersLayout::AboveContent)
            ->headerActions([
                Action::make('view')
                    ->size('lg')
                    ->color('primary')

                    ->label('New Event')
                    ->icon('heroicon-s-plus')

                    ->url(function () {
                        return route('event-create');
                    }),
            ])
            ->actions([
                Action::make('sendEmail')
                    ->label('SEND NOTIFICATIONS')
                    ->icon('heroicon-m-bell-alert')
                    ->size('lg')
                    ->modalWidth(MaxWidth::SevenExtraLarge)
                    ->form([
                        TextInput::make('title')->required(),
                        Textarea::make('body')->required(),
                        CheckboxList::make('departments')
                            ->required()
                            ->options(Department::where('name', '!=', 'All')->pluck('name', 'id'))
                            ->columns(2)
                            ->searchable()
                            ->gridDirection('row')
                            ->label('SELECT DEPARTMENT THAT YOU WANT TO BE NOTIFIED'),
                        // CheckboxList::make('departments')
                        // ->relationship(
                        //     name: 'departments',
                        //     titleAttribute: 'name'
                        // )


                        // ->getOptionLabelFromRecordUsing(fn (Model $record) => "{$record->name}")
                        // ->bulkToggleable()
                        // ->columns(3)
                        // ->gridDirection('row')
                        // ->searchable()

                        // ->label('SELECT DEPARTMENT THAT YOU WANT TO BE NOTIFIED'),
                        // Select::make('department_id')
                        // ->preload()
                        // ->native(false)
                        //                     ->required()
                        //                     ->label('BUILDING/DEPARTMENT')
                        //                     ->options(Department::get()->map(function ($d) {
                        //                         return ['name' => $d->getNameWithAbbreviation(), 'id' => $d->id];
                        //                     })->pluck('name', 'id'))
                        //                     ->searchable()

                    ])
                    ->button()
                    ->action(function (array $data) {

                        $newdata = [
                            'title' => $data['title'],
                            'body' => $data['body'],
                            'departments' =>  json_encode($data['departments'])
                        ];

                        $users = User::departmentBelong($data['departments'])->get();

                        // SendNotificationJob::dispatch($users, $newdata);

                        SendNotificationJob::dispatch($users, $newdata)->delay(now()->addMinutes(2));

                        return redirect()->route('monitor-sms');

                        //   dd($users);
                       
                        //return redirect()->route('event-announcement', $newdata);

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
                        ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                        ->disabledForm()
                        ->slideOver()
                        ->closeModalByClickingAway(true)

                        ->modalWidth(MaxWidth::Full),
                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function (Model $record) {
                        return route('event-edit', ['record' => $record]);
                    }),
                    Tables\Actions\DeleteAction::make(),
                ]),



            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn(Collection $records) => $records->each->delete())
                ])
                    ->label('ACTION'),
            ])
            ->groups([
                Group::make('academicYear.name')
                ->label('Academic Year'),
              
                Group::make('semester.name_in_number')
                ->label('Semester'),
              
            ])->defaultGroup('academicYear.name')
            ;
    }

    public function render(): View
    {
        return view('livewire.events.list-events');
    }
}
