<?php

namespace App\Livewire\Courses;

use Filament\Tables;
use App\Models\Course;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListCourses extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Course::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('abbreviation')
                    ->searchable(),
                    TextColumn::make('department.name'),
                 
                    TextColumn::make('sections.name')
                    ->listWithLineBreaks()
                    ->limitList(3)
                    ->expandableLimitedList()
                    
                // Tables\Columns\TextColumn::make('created_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
                // Tables\Columns\TextColumn::make('updated_at')
                //     ->dateTime()
                //     ->sortable()
                //     ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])

            ->headerActions([

                // CreateAction::make('create')->form(FilamentForm::courseForm())->label('New')->size('lg')
                // ->modalWidth(MaxWidth::SevenExtraLarge)
                // ->icon('heroicon-s-sparkles')
                Action::make('create')

                ->size('lg')
                ->color('primary')
                ->label('New')
                ->icon('heroicon-s-plus')
               
                ->url(function(){
                    return route('course-create');
                }),
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function(Model $record){
                        return route('course-edit', ['record'=> $record]);}),
                    Tables\Actions\DeleteAction::make('delete'),
                ]),
             
   
            ])
            ->bulkActions([
    
                Tables\Actions\BulkActionGroup::make([
                    BulkAction::make('delete')
                        ->requiresConfirmation()
                        ->action(fn (Collection $records) => $records->each->delete())
                ])
                ->label('ACTION')
                ,
               
            ]);
    }

    public function render(): View
    {
        return view('livewire.courses.list-courses');
    }
}
