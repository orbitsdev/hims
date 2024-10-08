<?php

namespace App\Livewire\Records;

use Filament\Tables;
use App\Models\Record;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\MedicalRecord;
use App\Models\EmergencyContact;
use App\Mail\BloodPressureStatus;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ColumnGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use App\Http\Controllers\SendingEmailController;
use Filament\Tables\Concerns\InteractsWithTable;

class ListMedicalRecord extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Record $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(MedicalRecord::query()->where('record_id', $this->record->id))
            ->columns([
                // Tables\Columns\TextColumn::make('record_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('user_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('recorder_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('record_batch_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('section_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('course_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('department_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('condition_id')
                //     ->numeric()
                //     ->sortable(),
                // Tables\Columns\TextColumn::make('record_title')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('batch_description')
                //     ->searchable(),


                ImageColumn::make('upload_image')
                ->disk('public')
                ->label('IMAGE')
                ->width(60)->height(60)
                ->url(fn (Model $record): null|string => $record->upload_image ?  Storage::disk('public')->url($record->upload_image) : null)
                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab()
                ->circular()
                ,

                ColumnGroup::make('DATES', [
                    Tables\Columns\TextColumn::make('academic_year_name')->label('ACADEMIC YEAR')
                    ->toggleable(isToggledHiddenByDefault: true)

                        ->searchable(),
                    Tables\Columns\TextColumn::make('semester_name')->label('SEMESTER')
                    ->toggleable(isToggledHiddenByDefault: true)
                        ->searchable(),

                ]),




                    ColumnGroup::make('PERSONAL DETAILS', [
                      Tables\Columns\TextColumn::make('first_name')->label('FIRST NAME')
                    ->searchable(),

                    Tables\Columns\TextColumn::make('last_name')->label('LAST NAME')

                    ->searchable(),


                         Tables\Columns\TextColumn::make('middle_name')->label('MIDDLE NAME')
                ->toggleable(isToggledHiddenByDefault: true)
                    ->searchable(),
                Tables\Columns\TextColumn::make('age')->label('AGE')
                ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric(),
                    // ->sortable(),
                Tables\Columns\TextColumn::make('weight')->label('WEIGHT')
                ->toggleable(isToggledHiddenByDefault: true)
                    ->numeric()
                    ->sortable(),

                    Tables\Columns\TextColumn::make('height')->label('HEIGHT')
                    ->toggleable(isToggledHiddenByDefault: true)
                        ->numeric()
                        ->sortable(),

                    Tables\Columns\TextColumn::make('birth_date')->label('BIRTH DATE')
                    ->toggleable(isToggledHiddenByDefault: true)
                        ->date()
                       ,
                    Tables\Columns\TextColumn::make('civil_status')
                    ->toggleable(isToggledHiddenByDefault: true)
                    ->label('CIVIL STATUS')
                        ->searchable(),

                    ]),

                    ColumnGroup::make('UNIVERSITY DETAILS', [
                        Tables\Columns\TextColumn::make('department_name')->label('DEPARTMENT')
                        // ->toggleable(isToggledHiddenByDefault: true)
                            ->searchable(),
                        Tables\Columns\TextColumn::make('role')->label('ROLE')
                        // ->toggleable(isToggledHiddenByDefault: true)
                               ->searchable(),


                    ]),
                    ColumnGroup::make('STUDENT INFO', [

                        Tables\Columns\TextColumn::make('section_name')->label('SECTION NAME')
                        ->toggleable(isToggledHiddenByDefault: true)
                            ->searchable(),

                 Tables\Columns\TextColumn::make('student_id_number')->label('STUDENT ID NUMBER')
                 ->toggleable(isToggledHiddenByDefault: true)
                     ->searchable(),

                    ]),

                // Tables\Columns\TextColumn::make('student_unique_id')
                //     ->searchable(),



                ColumnGroup::make('PHYSICAL EXAMINATION', [
                    Tables\Columns\TextColumn::make('temperature')->label('TEMPERATURE')
                    ->toggleable(isToggledHiddenByDefault: true)
                        ->numeric()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('blood_pressure')->label('BLOOD PRESSURE')
                    ->toggleable(isToggledHiddenByDefault: true)
                        ->searchable(),
                    Tables\Columns\TextColumn::make('systolic_pressure')->label('SYSTOLIC PRESSURE')
                    ->toggleable(isToggledHiddenByDefault: true)
                        ->numeric()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('diastolic_pressure')->label('DIASTOLIC PRESSURE')
                    ->toggleable(isToggledHiddenByDefault: true)
                        ->numeric()
                        ->sortable(),
                        ViewColumn::make('bp-risk')->view('tables.columns.b-p-risk-level')->label('BP RISK LEVEL')
                        // ->toggleable(isToggledHiddenByDefault: true)
                        ,

                    Tables\Columns\TextColumn::make('heart_rate')->label('HEART RATE')
                    ->toggleable(isToggledHiddenByDefault: true)
                        ->numeric()
                        ->sortable(),

                        Tables\Columns\TextColumn::make('condition.name')->label('CONDITION')
                         ->toggleable(isToggledHiddenByDefault: true, condition: true)
                            ->searchable(),
                ]),

                ColumnGroup::make('EXAMINATION DETAILS', [
                    Tables\Columns\TextColumn::make('date_of_examination')->label('Date of Examination')
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->date()
                        ->sortable(),
                    Tables\Columns\TextColumn::make('release_by')->label('Released By')
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->searchable(),
                    Tables\Columns\TextColumn::make('physician_name')->label('Physician Name')
                        ->toggleable(isToggledHiddenByDefault: true)
                        ->searchable(),
                ]),



                Tables\Columns\IconColumn::make('is_complete')->label('IS COMPLETE')
                ->toggleable(isToggledHiddenByDefault: true)
                    ->boolean(),

            ])
            ->filters([
                SelectFilter::make('condition_id')
                ->label('Condition')
                ->relationship('condition', 'name')
                ->searchable()
                ->preload()
                ,
                SelectFilter::make('section_id')
                ->label('section')
                ->relationship('section', 'name')
                ->searchable()
                ->preload()
                ,
            ])
            ->actions([

                ActionGroup::make([
                    Action::make('edit')
                    ->color('primary')
                    ->icon('heroicon-s-pencil-square')
                    ->tooltip('Update Medical Recurd')
                    // Identifier should be unique and camelCase
                        ->label('UPDATE RECORD') // Consistent casing
                        ->size('lg')

                        ->url(function (Model $record) {
                            return route('medical-record-edit', ['record' => $record]);
                        }),



                  
                    Action::make('download')
                    ->color('primary')
                    ->icon('heroicon-s-arrow-down-tray')
                    ->tooltip('DONNLOAD REPORT')
                    ->action(function(){
                        FilamentForm::notification('DOWNLOAD REPORT COMING SOON');
                    })
                    ->label('DOWNLOAD PDF') // Consistent casing
                    ->size('lg')
                    ->url(function(Model $record){
                        return route('reports.medical-record',['record'=> $record]);
                    })
                    ->openUrlInNewTab()
                    ,

                    Action::make('sms')

                    ->label('SEND SMS')
                    ->icon('heroicon-s-chat-bubble-left-ellipsis')
                    ->color('info')
                    ->size('lg')
                    ->requiresConfirmation()
                    ->fillForm(function (Model $record) {

                        return [
                            'to' => $record->user->email,
                        ];
                    })
                    ->form([
                        TextInput::make('to')->required()->disabled()->label('To'),
                        Textarea::make('message')->required()->maxLength(153),


                    ])
                    ->action(function (Model $record, array $data) {

                        $owner= $record->user;
                        if($owner){
                            FilamentForm::notification('SEND SMS TO  ' . $owner->fullNameWithEmail() . ' IS COMING SOON ' . $data['message']);
                            $record->record->notificationRequests()->create([
                                'message' => $data['message'],
                                'email' => $owner->email
                            ]);
                        }

                    })
                    ->tooltip('SEND MESSAGE TO USER')
                    ,
                    Action::make('send-email')
                    ->tooltip('SEND EMAIL TO USER')
                    ->label('SEND EMAIL')
                    ->icon('heroicon-s-envelope')
                    ->color('info')
                    ->size('lg')

                    ->fillForm(function (Model $record) {

                        return [
                            'to' => $record->user->email,
                        ];
                    })
                    ->form([
                        TextInput::make('to')->required()->disabled()->label('To'),
                        Textarea::make('message')->required(),


                    ])
                    ->action(function (Model $record, array $data) {

                        $owner= $record->user;
                        if($owner){
                            FilamentForm::notification('SEND EMAIL TO  ' . $owner->fullNameWithEmail() . ' IS COMING SOON ' . $data['message']);
                            $record->record->notificationRequests()->create([
                                'message' => $data['message'],
                                'email' => $owner->email
                            ]);
                        }

                    }),

                //     Action::make('send-blood-sms-alert')
                //     ->tooltip('NOTIFY USER BP STATUS BY SENDING SMS')
                //     ->label('SEND BP SMS ALERT')
                //     ->icon('heroicon-s-exclamation-circle')
                //     ->color('danger')
                //     ->size('lg')
                //    ->action(function (Model $record) {
                //     $suggestion = $record->getBloodPressureSuggestion();
                //     dd($suggestion);

                //     }),

                    Action::make('send-blood-email-alert')
                    ->tooltip('NOTIFY USER BP STATUS BY SENDING EMAIL')
                    ->label('SEND BP EMAIL ALERT')
                    ->icon('heroicon-s-exclamation-circle')
                    ->color('info')
                    ->size('lg')
                    ->requiresConfirmation()
                   ->action(function (Model $record) {


                      SendingEmailController::sendBPAlertEmail($record);

                }),




                    Tables\Actions\DeleteAction::make()->label('DELETE'),
                ])->hidden(function (Model $record) {


                    return $record->status;
                    // return $record->totalBatches() <= 0;
                }) ->tooltip('MANAGEMENT')   ,
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.records.list-medical-record');
    }
}
