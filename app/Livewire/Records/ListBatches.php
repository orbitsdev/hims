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
                            Textarea::make('message')->required()->maxLength(153),
    
                            CheckboxList::make('users')
                                ->label('Select Users')
                                // ->columns(2)
                                ->required()
                                ->searchable()
                                ->bulkToggleable()
                                ->options(function (Model $record) {
                                    return User::notAdmin()->notStaff()->hasPersonalDetails()->noRecordAcademicYearWithBatchDepartment($record)->get()->map(function ($item) {
                                        return [
                                            'name' => $item->fullNameWithEmail(),
                                            'id' => $item->id
                                        ];
                                    })->pluck('name', 'id');
                                })
    
    
                        ])
                        ->action(function (Model $record, array $data) {
    
    
    
    
                            foreach ($data['users'] as $userId) {
                                $user = User::find($userId);
                                FilamentForm::notification('SEND SMS TO  ' . $user->fullNameWithEmail() . ' IS COMING SOON');
                                $record->notificationRequests()->create([
                                    'message' => $data['message'],
                                    'email' => $user->email
                                ]);
                                
                                //  SendNotificationJob::dispatch($user, $record);
                            }
                        })->hidden(function (Model $record) {
                            return $record->totalUserOfThisBatch() == 0;
                        }),

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
