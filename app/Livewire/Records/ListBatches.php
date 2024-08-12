<?php

namespace App\Livewire\Records;

use App\Models\User;
use Filament\Tables;
use App\Models\Record;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\RecordBatch;
use App\Jobs\SendNotificationJob;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Components\Select;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
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
                    ->label('Start Record') // Consistent casing
                    ->icon('heroicon-m-user')
                    ->button()
                    ->size('lg')
                    ->url(function (Model $record) {
                        return route('by-batch-medical-recoding', ['record' => $record]);
                    })->hidden(function (Model $record) {
                        return $record->totalUserOfThisBatch() == 0;
                    }),
                Action::make('notify')
                    ->label('Notify')
                    ->icon('heroicon-m-user')
                    ->button()
                    ->size('lg')
                    ->form([

                        CheckboxList::make('users')
            ->label('Select Users')
            ->columns(2)
            ->searchable()
            ->bulkToggleable()
            ->options(User::all()->pluck('name','id'))

                      
                    ])
                    ->action(function (Model $record, array $data) {


                        foreach ($data['users'] as $userId) {
                            $user = User::find($userId);
                            SendNotificationJob::dispatch($user, $record);
                        }

                       
                        
                    })


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
