<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Student;
use Livewire\Component;
use App\Models\Semester;
use Filament\Tables\Table;
use App\Models\AcademicYear;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class StudentList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;


    public function table(Table $table): Table
    {
        return $table
            ->query(Student::query())
            ->columns([

                ImageColumn::make('image')
                ->disk('public')
                ->label('Profile')
                ->width(60)->height(60)
                ->url(fn (Student $record): null|string => $record->image ?  Storage::disk('public')->url($record->image) : null)
                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab()
                ->circular(),
                Tables\Columns\TextColumn::make('user.name')->formatStateUsing(function (Model $record) {
                    return $record->user->fullName() ?? '';
                })->searchable(isIndividual:true)->label('USER'),

                Tables\Columns\TextColumn::make('id_number')->label('ID NUMBER')
                    ->searchable(isIndividual:true),

                    Tables\Columns\TextColumn::make('user.email')->label('EMAIL')->wrap()->searchable(isIndividual:true),
                Tables\Columns\TextColumn::make('course.name')->label('COURSE')->wrap(),


                Tables\Columns\TextColumn::make('section.name')->label('SECTION'),

                Tables\Columns\TextColumn::make('department.name')->label('DEPARTMENT')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('created_at')
                //     ->date(),
                //     // ->sortable()
                //     // ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                // ->date()
                    // ->dateTime()
                    // ->sortable()
                    // ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                SelectFilter::make('department')
                    ->relationship('department', 'name')
                    ->searchable()
                    ->preload(),

                SelectFilter::make('section')
                    ->relationship('section', 'name')
                    ->searchable()
                    ->preload(),

                // // ✅ Fixed Academic Year Filter
                // Filter::make('academic_year')
                //     ->form([
                //         Select::make('academic_year')
                //             ->options(AcademicYear::pluck('name', 'id')->toArray()) // Fetch academic years dynamically
                //             ->searchable()
                //             ->preload()
                //             ->label('Academic Year'),
                //     ])
                //     ->query(fn (Builder $query, array $data) =>
                //         $query->when($data['academic_year'] ?? null, fn (Builder $query, $yearId) =>
                //             $query->where('academic_year_id', $yearId) // Ensure you have academic_year_id in students table
                //         )
                //     ),

                // // ✅ Fixed Semester Filter
                // Filter::make('semester')
                //     ->form([
                //         Select::make('semester')
                //             ->options(Semester::pluck('name_in_text', 'id')->toArray()) // Fetch semesters dynamically
                //             ->searchable()
                //             ->preload()
                //             ->label('Semester'),
                //     ])
                //     ->query(fn (Builder $query, array $data) =>
                //         $query->when($data['semester'] ?? null, fn (Builder $query, $semesterId) =>
                //             $query->where('semester_id', $semesterId) // Ensure you have semester_id in students table
                //         )
                //     ),
            ], layout: FiltersLayout::AboveContent)

            ->actions([
                Action::make('view')
                ->button()
                ->outlined()
                // ->color('success')
                ->label('View')
                ->modalContent(function (Student $record) {
                    return view('livewire.students.view-student', ['record' => $record]);
                })
                ->modalHeading('Details')
                ->modalSubmitAction(false)
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                ->disabledForm()
                 ->slideOver()
                 ->closeModalByClickingAway(true)

                ->modalWidth(MaxWidth::Full),

                Action::make('print')
                ->button()
                ->outlined()
                ->icon('heroicon-s-printer')
                ->label('Print Details')
                 ->openUrlInNewTab()
                ->url(function(Model $record){
                    return route('print-student',['record'=> $record]);
                }),

                Action::make('View Medical Record')
                ->button()
                ->outlined()
                ->icon('heroicon-s-printer')
        ->label('Medical Records')
                ->modalContent(function (Student $record) {
                    return view('livewire.all-medical-recors', ['record' => $record->user]);
                })
                ->modalHeading('Medical Records')
                ->modalSubmitAction(false)
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                ->disabledForm()

                 ->closeModalByClickingAway(true)

                ->modalWidth('7xl'),
                ActionGroup::make([


                ])->tooltip('MANAGEMENT'),




            ])
            ->openRecordUrlInNewTab()
            ->bulkActions([

             ]);
    }
    public function render()
    {
        return view('livewire.student-list');
    }
}
