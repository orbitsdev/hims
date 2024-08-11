<?php

namespace App\Livewire\Sections;

use Filament\Tables;
use App\Models\Section;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Grouping\Group;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Filament\Tables\Actions\ActionGroup;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListSections extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Section::query())
            ->columns([
                Tables\Columns\TextColumn::make('name') ->searchable(),
                Tables\Columns\TextColumn::make('course.name')->searchable(),
                Tables\Columns\TextColumn::make('course.department.name')->searchable()

               
            ])

            ->filters([
                //
            ])
            ->headerActions([
                Tables\Actions\CreateAction::make('create')->form(FilamentForm::sectionForm())
            ])
            ->actions([
                ActionGroup::make([
                    Tables\Actions\EditAction::make('edit')->form(FilamentForm::sectionForm()),
                    Tables\Actions\DeleteAction::make(),
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
            ])
            ->groups([
                Group::make('course.name')
                    ->label('Course'),
                Group::make('course.department.name')
                    ->label('Department')
            ])->defaultGroup('course.name')
            ;
    }

    public function render(): View
    {
        return view('livewire.sections.list-sections');
    }
}
