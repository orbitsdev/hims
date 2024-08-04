<?php

namespace App\Livewire\FirstAidGuides;

use Filament\Tables;
use Filament\Tables\Enums\FiltersLayout;
use Livewire\Component;
use Filament\Tables\Table;

use App\Models\FirstAidGuide;
use Filament\Actions\CreateAction;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;
use Filament\Tables\Actions\CreateAction as TCreateAction;

class ListFirstAidGuides extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(FirstAidGuide::query())
            ->columns([
                Tables\Columns\TextColumn::make('title')
                ->searchable(),

                Tables\Columns\TextColumn::make('condition.name')
                    ->sortable(),
               
            ])
            ->filters([
                SelectFilter::make('condition')
                    ->relationship('condition', 'name')
                    ->searchable()
                    ->preload()
            ], layout: FiltersLayout::AboveContent)

            ->headerActions([

                TCreateAction::make()->form(FilamentForm::firstAidGuideForm())->label('New')->size('lg')
                ->icon('heroicon-s-sparkles')
                // Action::make('create')

                // ->size('lg')
                // ->color('primary')
                // ->label('First Aid')
                // ->icon('heroicon-s-plus')
               
                // ->url(function(){
                //     return route('staffs-create');
                // }),
            ])
            ->actions([
                Action::make('view')
                ->color('success')
                ->label('View')
                ->size('xl')
                ->icon(null)
                ->link()
              
                ->extraAttributes([
                    'class' => 'border: none !imporant',
                ])
                ->modalContent(function (Model $record) {
                    return view('livewire.first-aid-fuides.view-first-aid-guide', ['record' => $record]);
                })
                ->modalSubmitAction(false)
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                ->disabledForm()
                 ->slideOver()
                 ->closeModalByClickingAway(true)
           
                ->modalWidth(MaxWidth::Full),
                    Tables\Actions\EditAction::make()->form(FilamentForm::firstAidGuideForm()) ->modalWidth(MaxWidth::SevenExtraLarge), 
                    Tables\Actions\DeleteAction::make(),
       
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
        return view('livewire.first-aid-guides.list-first-aid-guides');
    }
}
