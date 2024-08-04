<?php

namespace App\Livewire\Conditions;

use Filament\Tables;
use Livewire\Component;
use App\Models\Condition;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListConditions extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Condition::query())
            ->columns([

                ImageColumn::make('file.file')
                ->disk('public')
                ->label('Profile')
                ->width(60)->height(60)
                ->url(fn (Model $record): null|string => $record->file ?  Storage::disk('public')->url($record->file) : null)
                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab(),
               
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                TextColumn::make('symptoms.name')
                ->listWithLineBreaks()
                ->bulleted()
                ,
                TextColumn::make('treatments.name')
                ->listWithLineBreaks()
                ->bulleted()
                ,
                // TextColumn::make('treatments_count')->counts([
                //     'treatments' => fn (Builder $query) => $query,
                // ])->label('Treatments'),



            ])
            ->filters([

            ])
            ->headerActions([
                CreateAction::make('create')->form([
                    TextInput::make('name')->required(),
                ])  ->size('lg')
                ->icon('heroicon-s-sparkles')

            ])
            ->actions([
                ActionGroup::make([
                    Action::make('viewTreatment')
                    ->color('success')
                    ->label('View')
                    ->size('xl')
                    ->icon(null)
                    
                    ->modalContent(function (Model $record) {
                        return view('livewire.conditions.view-condition', ['record' => $record]);
                    })
                    ->modalHeading('Account Details')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->disabledForm()
                     ->slideOver()
                     ->closeModalByClickingAway(true)
               
                    ->modalWidth(MaxWidth::Full),
                    
                    Action::make('MANAGE')
                    ->color('info')
                    ->icon('heroicon-m-pencil-square')
                    ->label('Manage')
                    ->url(function (Model $record) {
                            return route('manage-condition', ['record' => $record]);
                    } ),
    
    
                
                   
                    // EditAction::make('edit')->form([
                    // TextInput::make('name')->required(),
                    // ]),
                    DeleteAction::make(),
                ]),
               
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.conditions.list-conditions');
    }
}
