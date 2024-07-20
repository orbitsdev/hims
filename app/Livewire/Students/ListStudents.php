<?php

namespace App\Livewire\Students;

use Filament\Tables;
use App\Models\Student;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
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
                Tables\Columns\TextColumn::make('user.name')->formatStateUsing(function (Model $record) {
                    return $record->user->fullName() ?? '';
                })->searchable(),
              
                Tables\Columns\TextColumn::make('id_number')
                    ->searchable(),
                Tables\Columns\TextColumn::make('department.name')
                    ->numeric()
                    ->sortable()->label('Department'),

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
                ->button()
                ->url(function(){
                    return route('create-student');
                }),
            ])
            ->actions([
                Tables\Actions\DeleteAction::make()->button(),
                Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->button()->url(function(Model $record){
                    return route('edit-student', ['record'=> $record]);
                }),
              
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
