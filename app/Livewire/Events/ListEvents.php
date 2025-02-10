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
use Illuminate\Support\Facades\Log;
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
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use App\Services\TeamSSProgramSmsService;
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
                    ->relationship('academicYear', 'name', fn(Builder $query) => $query->hasEvents())
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
                Action::make('sendSMS')
                ->label('SEND SMS')
                ->icon('heroicon-m-bell-alert')
                ->size('lg')
                ->modalWidth(MaxWidth::SevenExtraLarge)
                ->form([
                    Textarea::make('message')
                        ->required()
                        ->maxLength(153)
                        ->hint('SMS MESSAGE'),
                    CheckboxList::make('departments')
                        ->required()
                        ->options(Department::where('name', '!=', 'All')->pluck('name', 'id'))
                        ->columns(2)
                        ->searchable()
                        ->gridDirection('row')
                        ->label('SELECT DEPARTMENT/BUILDING THAT YOU WANT TO BE NOTIFIED'),
                ])
                ->button()
                ->action(function (array $data) {
                    $smsService = new TeamSSProgramSmsService();
                    $message = $data['message'];
            
                    // Retrieve users by selected departments
                    $users = User::departmentBelong($data['departments'])->get();
            
                    if ($users->isEmpty()) {
                        Notification::make()
                            ->title('No Recipients')
                            ->danger()
                            ->body('No users found with a valid phone number in the selected departments.')
                            ->send();
                        return;
                    }
            
                    // Extract valid phone numbers
                    $phoneNumbers = $users->map(function ($user) {
                        if ($user->student && $user->student->personalDetail) {
                            return $user->student->personalDetail->phone;
                        }
                        if ($user->staff && $user->staff->personalDetail) {
                            return $user->staff->personalDetail->phone;
                        }
                        if ($user->personnel && $user->personnel->personalDetail) {
                            return $user->personnel->personalDetail->phone;
                        }
                        return null;
                    })->filter()->toArray();
            
                    if (empty($phoneNumbers)) {
                        Notification::make()
                            ->title('No Recipients')
                            ->danger()
                            ->body('No valid phone numbers found in the selected departments.')
                            ->send();
                        return;
                    }
            
                    Log::info('Phone Numbers:', $phoneNumbers);
            
                    try {
                        // Send bulk SMS
                        $response = $smsService->sendBulkSms($phoneNumbers, $message);
            
                        Log::info('Bulk SMS Response:', $response);
            
                        if (isset($response['error']) && $response['error']) {
                            Notification::make()
                                ->title('SMS Failed')
                                ->danger()
                                ->body('Failed to send SMS: ' . $response['message'])
                                ->send();
                        } else {
                            Notification::make()
                                ->title('SMS Sent')
                                ->success()
                                ->body('SMS successfully sent to ' . count($phoneNumbers) . ' users.')
                                ->send();
                        }
                    } catch (\Exception $e) {
                        Log::error('Error Sending Bulk SMS: ' . $e->getMessage());
                        Notification::make()
                            ->title('SMS Failed')
                            ->danger()
                            ->body('An error occurred: ' . $e->getMessage())
                            ->send();
                    }
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
                ])->tooltip('MANAGEMENT'),



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
