<?php

namespace App\Livewire\Departments;

use Filament\Tables;
use Livewire\Component;
use App\Models\Department;
use Filament\Tables\Table;
use Illuminate\Contracts\View\View;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListDepartments extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;



    public function table(Table $table): Table
    {
        return $table
            ->query(Department::query())
            ->columns([

                ImageColumn::make('image')
                ->disk('public')
                ->label('LOGO')
                ->width(60)->height(60)
                ->url(fn (Department $record): null|string => $record->image ?  Storage::disk('public')->url($record->image) : null)
                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab()
                ->circular()
                ,

                Tables\Columns\TextColumn::make('name')->label('NAME')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')->label('GROUP')
                    ->searchable(),
                Tables\Columns\TextColumn::make('abbreviation')->label('ABBREVIATION')
                    ->searchable(),

            ])
            ->filters([
                //
            ])
            ->headerActions([

                    CreateAction::make('create')
                    ->size('lg')
                    ->mutateFormDataUsing(function (array $data): array {

                        return $data;
                    })
                    ->icon('heroicon-s-sparkles')
                    ->label('New ')
                    ->form(FilamentForm::departmentForm()) ->modalWidth('7xl')
                    ->createAnother(false)
            ])
            ->actions([
                Tables\Actions\EditAction::make()->form(FilamentForm::departmentForm())
                    ->hidden(function(Model $record){
                        return $record->name == 'ALL';
                    }) ->modalWidth('7xl'),
                    Tables\Actions\DeleteAction::make()->hidden(function(Model $record){
                        return $record->name == 'ALL';
                    })->before(function (DeleteAction $action,Model $record) {

                        if ($record->hasRelatedRecords()) {
                            Notification::make()
                                ->title('Deletion Not Allowed')
                                ->body('This department cannot be deleted because it has associated records.')
                                ->danger()
                                ->send();

                                $action->halt();
                                $action->cancel();
                        }

                    })
                     ,
                //edit actions

                    // ->createAnother(false)
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
        return view('livewire.departments.list-departments');
    }
}
