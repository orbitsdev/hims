<?php

namespace App\Livewire\Students;

use Filament\Tables;
use App\Models\Student;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ImageColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListStudents extends Component implements HasForms, HasTable
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
                })->searchable(),
              
                Tables\Columns\TextColumn::make('id_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department_id')
                ->formatStateUsing(function (Model $record) {
                    return $record->department->getNameWithAbbreviation() ?? '';
                })->searchable(),
                   

                // Tables\Columns\TextColumn::make('department')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('created_at')
                    ->date(),
                    // ->sortable()
                    // ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->date()
                    // ->dateTime()
                    // ->sortable()
                    // ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('view')
                ->color('primary')
                ->label('Add New Student')
                ->icon('heroicon-s-plus')
               
                ->url(function(){
                    return route('create-student');
                }),
            ])
            ->actions([
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
                 Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function(Model $record){
                            return route('user-edit', ['record'=> $record]);
             }),
                Tables\Actions\DeleteAction::make(),
                
              
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete())
                ])
                ->label('ACTION')
                ,            ]);
    }

    public function render(): View
    {
        return view('livewire.students.list-students');
    }
}
