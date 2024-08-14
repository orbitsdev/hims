<?php

namespace App\Livewire\Records;

use Filament\Tables;
use App\Models\Record;
use Livewire\Component;
use App\Models\Semester;
use Filament\Tables\Table;
use App\Models\AcademicYear;
use Filament\Actions\CreateAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Columns\ToggleColumn;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\CheckboxColumn;
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
                Tables\Columns\TextColumn::make('academicYear.name')->label('ACADEMIC YEAR')->searchable(),

                Tables\Columns\TextColumn::make('semester')->formatStateUsing(function (Model $record) {
                    return $record->semester->semesterWithYear();
                })->label('SEMESTER'),

                ViewColumn::make('last_name')->view('tables.columns.record-batch-detail')->label('BATCH'),

                
                    CheckboxColumn::make('status')->label('MARK AS DONE')->afterStateUpdated(function ($record, $state) {
                        FilamentForm::notification($state ? 'Mark as Done' : 'Mark as Incomplete');
                    }) ,

                    Tables\Columns\TextColumn::make('created_at')->label('CREATED AT')->date(),


                    
            ])
            ->filters([
                SelectFilter::make('ACADEMIC YEAR')
                    ->label('ACADEMIC YEAR')
                    ->relationship('academicYear', 'name', fn(Builder $query) => $query->hasRecords())
                    ->searchable()
                    ->preload(),

                // SelectFilter::make('SEMESTER')
                // ->label('SEMESTER')
                // ->relationship('semester', 'name_in_text')
                // ->searchable()
                // ->preload()


                //  Filter::make('filter')
                //  ->columns([
                //     'sm' => 3,
                //     'xl' => 6,
                //     '2xl' =>6,
                // ])
                // ->form([

                //     Select::make('academic_year_id')
                //     ->columnSpan(1)
                //     ->label('ACADEMIC YEAR')
                //     ->options(
                //         AcademicYear::all()->pluck('name', 'id')->put(-1, 'None')->all()
                //     )
                //     ->reactive()
                //     ->afterStateUpdated(fn (callable $set) => $set('areas', null)),
                // Select::make('semester_id')
                // ->columnSpan(1)
                //     ->label('SEMESTER')
                //     ->options(
                //         function (callable $get) {
                //             if (filled($semester_id = $get('academic_year_id'))) {
                //                 $academicYear = AcademicYear::find($semester_id);
                //                 return $academicYear->semesters->map(function($item){
                //                     return [
                //                         'name'=> $item->semesterWithYear(),
                //                         'id'=> $item->id,
                //                     ];
                //                 })->pluck('name', 'id')->all();
                //             } else {
                //                 return Semester::all()->map(function($item){
                //                     return [
                //                         'name'=> $item->semesterWithYear(),
                //                         'id'=> $item->id,
                //                     ];
                //                 })->pluck('name', 'id')->all();
                //             }
                //         }
                //     )
                //     ->reactive()
                //     ->afterStateUpdated(fn (callable $set) => $set('semester_id', null)),

                // ])  ->columnSpanFull()
                // ->query(function (Builder $query, array $data): Builder {
                //     return $query
                //         ->when(
                //             $data['academic_year_id'] === -1,
                //             fn (Builder $query): Builder => $query->whereNull('academic_year_id'),
                //         );
                // }),

            ], layout: FiltersLayout::AboveContent)
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


                    ->url(function () {
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
                Action::make('view')
                    ->size('lg')
                    ->color('primary')

                    ->label('New Record')
                    ->icon('heroicon-s-plus')

                    ->url(function () {
                        return route('event-create');
                    }),
            ])
            ->actions([
                Action::make('collections')
                ->tooltip('MEDICAL RECORD STORAGE')  
                // Identifier should be unique and camelCase
                ->label('COLLECTIONS') // Consistent casing
                ->icon('heroicon-o-folder-open')
                 ->button()
                 ->size('lg')
                 ->url(function (Model $record) {
                    return route('record-list-medical-record',['record'=> $record]);
                })
                
                 ,
                
               
               

                  
                    


                ActionGroup::make([

                    Action::make('recordIndividually') // Identifier should be unique and camelCase
                    ->tooltip('Record Individually')   
                    ->color('primary')
                    ->label('RD INDIVIDUAL') // Consistent casing
                        ->icon('heroicon-o-user')
                      
                        ->size('lg')
                        ->url(function (Model $record) {
                            return route('individual-medical-recoding', ['record' => $record]);
                        })->hidden(function(Model $record){
                           
                            return $record->status;
                        }),
    
                    Action::make('recordByBatch')
                    ->color('primary')
                    ->tooltip('Record By Batch')
                    // Identifier should be unique and camelCase
                        ->label('RD BY BATCH') // Consistent casing
                        ->icon('heroicon-o-chart-bar')
                        ->size('lg')
                        
                        ->url(function (Model $record) {
                            return route('batches', ['record' => $record]);
                        })->hidden(function (Model $record) {
    
                           
                            return ($record->totalBatches() == 0 || $record->status);
                            // return $record->totalBatches() <= 0;
                        }),
                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function (Model $record) {
                        return route('record-edit', ['record' => $record]);
                    }),
                    Tables\Actions\DeleteAction::make(),
                ])->hidden(function (Model $record) {

                    
                    return $record->status;
                    // return $record->totalBatches() <= 0;
                }) ->tooltip('MANAGEMENT')   ,




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
                Group::make('semester.name_in_text')
                    ->label('Semester')
            ])->defaultGroup('academicYear.name');
    }

    public function render(): View
    {
        return view('livewire.records.list-records');
    }
}
