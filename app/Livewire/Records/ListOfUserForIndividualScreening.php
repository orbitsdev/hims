<?php

namespace App\Livewire\Records;

use App\Models\User;
use Filament\Tables;
use App\Models\Record;
use Livewire\Component;
use Filament\Tables\Table;
use App\Mail\AnouncementMail;

use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Log;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use App\Services\TeamSSProgramSmsService;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListOfUserForIndividualScreening extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Record $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->notAdmin()->notStaff()->hasPersonalDetails()->noRecordInThisAcademicYearAndSemester($this->record)->orderBy('name'))
            ->columns([

                ImageColumn::make('profile_photo_path')
                    ->disk('public')
                    ->label('Profile')
                    ->width(60)->height(60)
                    ->url(fn(User $record): null|string => $record->profile_photo_path ?  Storage::disk('public')->url($record->profile_photo_path) : null)
                    ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                    ->openUrlInNewTab()
                    ->circular(),


                Tables\Columns\TextColumn::make('name')
                    ->searchable()->label('ACCOUNT'),
                // Tables\Columns\TextColumn::make('name')
                //     ->searchable(),


                // Tables\Columns\TextColumn::make('name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('username')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('email')
                //     ->searchable(),

                ViewColumn::make('first_name')->view('tables.columns.user-first-name')->label('FIRST NAME')
                    ->searchable(query: function (Builder $query, string $search, ?Model $record): Builder {

                        return $query->personalDetailsSearch($search);
                    }),

                ViewColumn::make('last_name')->view('tables.columns.user-last-name')->label('LAST NAME'),
                ViewColumn::make('middle_name')->view('tables.columns.user-middle-name')->label('MIDDLE NAME'),

                Tables\Columns\TextColumn::make('role')->label('Role')
                    ->color(fn(string $state): string => match ($state) {
                        User::ADMIN => 'primary',
                        User::PERSONNEL => 'info',
                        User::STAFF => 'warning',
                        User::STUDENT => 'success',
                        default => 'gray',
                    })
                    ->searchable()->label('ROLE'),


                ViewColumn::make('department')->view('tables.columns.user-department')->label('DEPARTMENT'),

                // ViewColumn::make('status')->view('tables.columns.medical-status-column')->label('MEDICAL STATUS'),


            ])
            ->filters([
                // SelectFilter::make('role')
                // ->label('Role')
                //     ->options(User::ROLES),

            ], layout: FiltersLayout::AboveContent)
            ->actions([

                Action::make('edit')

                    ->size('lg')
                    ->button()
                    ->color('primary')
                    ->label('CREATE MEDICAL RECORD')

                    ->modalWidth('7xl')

                    // ->form(FilamentForm::medicalForm())


                    ->url(function (Model $user) {
                        return route('medical-record-create', ['record' => $this->record, 'user' => $user]);
                    }),


                ActionGroup::make([
                    Action::make('notify')
                        ->label('SEND SMS')
                        ->icon('heroicon-o-bell')

                        ->size('lg')
                        ->requiresConfirmation()
                        ->form([
                            TextInput::make('to')
                                ->required()
                                ->disabled() 
                                ->label('To'),
                            Textarea::make('message')
                                ->required()
                                ->maxLength(153) 
                                ->label('Message'),
                        ])
                        ->fillForm(function (Model $record) {
                            // Determine the phone number from associated relationships
                            $phone = null;
                    
                            if ($record->student && $record->student->personalDetail) {
                                $phone = $record->student->personalDetail->phone;
                            }
                            if ($record->staff && $record->staff->personalDetail) {
                                $phone = $record->staff->personalDetail->phone;
                            }
                            if ($record->personnel && $record->personnel->personalDetail) {
                                $phone = $record->personnel->personalDetail->phone;
                            }
                    
                            return [
                                'to' => $phone ?? $record->phone, // Default to $record->phone if no relationship matches
                            ];
                        })
                        ->action(function (Model $record, array $data) {
                            $smsService = new TeamSSProgramSmsService();
                    
                            // Use the phone number from the form data
                            $number = null;
                    
                            if ($record->student && $record->student->personalDetail) {
                                $number = $record->student->personalDetail->phone;
                            }
                            if ($record->staff && $record->staff->personalDetail) {
                                $number = $record->staff->personalDetail->phone;
                            }
                            if ($record->personnel && $record->personnel->personalDetail) {
                                $number = $record->personnel->personalDetail->phone;
                            }

                            $message = $data['message'];
                    
                            // Validate the phone number
                            if (!$number) {
                                Notification::make()
                                    ->title('SMS Failed')
                                    ->danger()
                                    ->body('The phone number is missing or invalid.')
                                    ->send();
                    
                                Log::error('Phone number is missing or invalid. SMS not sent.');
                                return;
                            }
                    
                            try {
                                // Send the SMS
                                $response = $smsService->sendSms($number, $message);
                    
                                Log::info('TeamSSProgram SMS Response:', $response);
                    
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
                                        ->body('SMS sent successfully to ' . $number)
                                        ->send();
                                }
                            } catch (\Exception $e) {
                                Log::error('Error Sending SMS: ' . $e->getMessage());
                    
                                Notification::make()
                                    ->title('SMS Failed')
                                    ->danger()
                                    ->body('An error occurred: ' . $e->getMessage())
                                    ->send();
                            }
                        }),

                    // Action::make('view')
                    //     ->icon('heroicon-o-eye')
                    //     ->label('VIEW SENT SMS')




                    //     ->outlined()
                    //     ->modalSubmitAction(false)
                    //     ->modalCancelAction(fn(StaticAction $action) => $action->label('Close'))
                    //     ->disabledForm()
                    //     ->modalContent(fn(Model $record): View => view(
                    //         'livewire.view-send-notification',
                    //         ['record' => $record],
                    //     ))
                    //     ->modalWidth(MaxWidth::SevenExtraLarge),
                ]),


            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {

        return view('livewire.records.list-of-user-for-individual-screening');
    }
}
