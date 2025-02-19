<?php

namespace App\Livewire\AcademicYear;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\AcademicYear;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListAcademicYear extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function academicForm(): array {
        return [
            TextInput::make('name')->required()->label('NAME')
            ->unique(ignoreRecord: true)
            ->mask('9999-9999')
            ->default(AcademicYear::suggestion())
             ->columnSpanFull(),

        ];
    }

    public function table(Table $table): Table
    {
        return $table
            ->query(AcademicYear::query())
            ->columns([
                Tables\Columns\TextColumn::make('name')->label('ACADEMIC YEAR')
                    ->searchable(),

            ])
            ->headerActions([

                CreateAction::make('create')
                ->size('lg')
                ->mutateFormDataUsing(function (array $data): array {

                    return $data;
                })
                ->icon('heroicon-s-sparkles')
                ->label('New')
                ->form($this->academicForm())->modalWidth('7xl')
                ->createAnother(false)
        ])
        ->actions([
            Tables\Actions\EditAction::make()->form($this->academicForm())->modalWidth('7xl'),
            Tables\Actions\DeleteAction::make()

            ->before(function (DeleteAction $action,Model $record) {

                if ($record->hasRelatedRecords()) {
                    Notification::make()
                        ->title('Deletion Not Allowed')
                        ->body('This academic year cannot be deleted because it has associated records, semesters, or events.')
                        ->danger()
                        ->send();

                        $action->halt();
                        $action->cancel();
                }

            }),
           
            //edit actions

                // ->createAnother(false)
        ])
        ->bulkActions([
            Tables\Actions\BulkActionGroup::make([
                // BulkAction::make('delete')
                //     ->requiresConfirmation()
                //     ->action(fn (Collection $records) => $records->each->delete())
            ])
            ->label('ACTION')
            ,
        ]);
    }

    public function render(): View
    {
        return view('livewire.academic-year.list-academic-year');
    }
}
