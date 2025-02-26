<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Student;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
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
                })->searchable()->label('USER'),

                Tables\Columns\TextColumn::make('id_number')->label('ID NUMBER')
                    ->searchable(),

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
                ->preload()
                ,

                SelectFilter::make('section')

                ->relationship('section', 'name')
                ->searchable()
                ->preload()
                //
            ],layout: FiltersLayout::AboveContent)

            ->actions([

                ActionGroup::make([
                    Action::make('view')
                    ->color('success')
                    ->icon('heroicon-m-eye')
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

                    Action::make('View Medical Record')
                    ->icon('heroicon-m-eye')
                    ->label('View')
                    ->modalContent(function (Student $record) {
                        return view('livewire.all-medical-recors', ['record' => $record->user]);
                    })
                    ->modalHeading('Medical Records')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->disabledForm()

                     ->closeModalByClickingAway(true)

                    ->modalWidth('7xl'),

                ])->tooltip('MANAGEMENT'),




            ])
            ->bulkActions([

             ]);
    }
    public function render()
    {
        return view('livewire.student-list');
    }
}
