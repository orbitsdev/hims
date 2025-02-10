<?php

namespace App\Livewire\Records;

use App\Models\User;
use Filament\Tables;
use App\Models\Record;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\RecordBatch;
use App\Jobs\SendNotificationJob;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\CheckboxList;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListBatches extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Record $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(RecordBatch::query()->recordBatchList($this->record))
            ->columns([
                Tables\Columns\TextColumn::make('description')->label('Description')
                    ->sortable(),
                // Tables\Columns\TextColumn::make('record.title')
                //     ->sortable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->numeric()
                    ->sortable(),
                Tables\Columns\TextColumn::make('section.name')
                    ->numeric()
                    ->sortable(),



                ViewColumn::make('notifications')->view('tables.columns.record-batch-notification-request')->label('Notificaiton Sent'),
                ViewColumn::make('users')->view('tables.columns.batch-users')->label('Available'),

                //                 ToggleColumn::make('is_complete')

                // ->afterStateUpdated(function ($record, $state) {
                //         FilamentForm::notification( $state ? 'Mark as complete ' : 'Mark as incomplete');
                // })->label('Is Complete'),


                // IconColumn::make('is_complete')
                // ->boolean()
                // ->label('Is Complete')

                // IconColumn::make('is_complete')->label('IS COMPLETE')
                // ->boolean()
                // ->size(IconColumn\IconColumnSize::Large)
                // ->trueIcon('heroicon-s-check-circle')
                // ->falseIcon('heroicon-o-minus'),

            ])
            ->filters([
                //
            ])
            ->actions([
                Action::make('userByBatch') // Identifier should be unique and camelCase
                    ->label('START RECORDING')
                    ->color('success') // Consistent casing
                    ->icon('heroicon-o-user')
                    ->button()
                    ->size('lg')
                    ->url(function (Model $record) {
                        return route('by-batch-medical-recoding', ['record' => $record]);
                    })->hidden(function (Model $record) {
                        return $record->totalUserOfThisBatch() == 0;
                    }),
                   
                    ActionGroup::make([
                        Action::make('notify')
                        ->label('SEND SMS')
                        ->icon('heroicon-o-bell')
                        ->size('lg')
                        ->form([
                            Textarea::make('message')
                                ->required()
                                ->maxLength(153),
                            CheckboxList::make('users')
                                ->label('Select Users')
                                ->required()
                                ->searchable()
                                ->bulkToggleable()
                                ->options(function (Model $record) {
                                    return User::notAdmin()
                                        ->notStaff()
                                        ->hasPersonalDetails()
                                        ->noRecordAcademicYearWithBatchDepartment($record)
                                        ->where(function ($query) {
                                            $query->whereHas('student', function ($q) {
                                                $q->whereHas('personalDetail', function ($q) {
                                                    $q->whereNotNull('phone')->where('phone', '!=', '');
                                                });
                                            })
                                            ->orWhereHas('staff', function ($q) {
                                                $q->whereHas('personalDetail', function ($q) {
                                                    $q->whereNotNull('phone')->where('phone', '!=', '');
                                                });
                                            })
                                            ->orWhereHas('personnel', function ($q) {
                                                $q->whereHas('personalDetail', function ($q) {
                                                    $q->whereNotNull('phone')->where('phone', '!=', '');
                                                });
                                            })
                                            ->orWhereNotNull('phone'); // Include users with phone numbers in the users table
                                        })
                                        ->get()
                                        ->map(function ($item) {
                                            return [
                                                'name' => $item->fullNameWithEmail(),
                                                'id' => $item->id
                                            ];
                                        })
                                        ->pluck('name', 'id');
                                }),
                        ])
                        ->action(function (Model $record, array $data) {
                            $smsService = new TeamSSProgramSmsService();
                            $message = $data['message'];
                            $validUsers = [];
                
                            foreach ($data['users'] as $userId) {
                                $user = User::find($userId);
                
                                // Ensure user exists and has a valid phone number
                                $phoneNumber = $user->student?->personalDetail?->phone
                                    ?? $user->staff?->personalDetail?->phone
                                    ?? $user->personnel?->personalDetail?->phone
                                    ?? $user->phone; // Fallback to user's `phone` field
                
                                if ($phoneNumber) {
                                    $validUsers[] = [
                                        'user' => $user,
                                        'phone' => $phoneNumber,
                                    ];
                                }
                            }
                
                            // If no valid users, notify and return
                            if (empty($validUsers)) {
                                Notification::make()
                                    ->title('No Recipients')
                                    ->danger()
                                    ->body('No users with a valid phone number were found.')
                                    ->send();
                                return;
                            }
                
                            // Extract only phone numbers for bulk SMS
                            $phoneNumbers = array_map(fn($validUser) => $validUser['phone'], $validUsers);
                
                            Log::info('Sending Bulk SMS to:', $phoneNumbers);
                
                            try {
                                // Send Bulk SMS
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
                        })
                        ->hidden(function (Model $record) {
                            return $record->totalUserOfThisBatch() == 0;
                        }),
                    ]),

                        Action::make('view')
                        ->icon('heroicon-o-eye')
                    ->label('VIEW SENT SMS')
    
                   


                    ->outlined()
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->disabledForm()
                    ->modalContent(fn (Model $record): View => view(
                        'livewire.record-batch-notfication-request',
                        ['record' => $record],
                    ))
                    ->modalWidth(MaxWidth::SevenExtraLarge)
                    ,
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
        return view('livewire.records.list-batches');
    }
}
