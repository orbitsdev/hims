<?php

namespace App\Livewire\Personnels;

use Filament\Tables;
use Livewire\Component;
use App\Models\Personnel;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Notifications\Notification;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Actions\DeleteAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListPersonnels extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Personnel::query())
            ->columns([
                ImageColumn::make('image')
                ->disk('public')
                ->label('Profile')
                ->width(60)->height(60)
                ->url(fn (Personnel $record): null|string => $record->image ?  Storage::disk('public')->url($record->image) : null)
                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab()
                ->circular(),
                Tables\Columns\TextColumn::make('user.name')->formatStateUsing(function (Model $record) {
                    return $record->user->fullName() ?? '';
                })->searchable(),


                Tables\Columns\TextColumn::make('department.name')->label('DEPARTMENT')
                    ->searchable(),
            ])
            ->filters([
                //
            ])
            ->headerActions([
                Action::make('view')
                ->size('lg')
                ->color('primary')
                ->label('New Personnel')
                ->icon('heroicon-s-plus')
                ->button()
                ->url(function(){
                    return route('personnel-create');
                }),
            ])
            ->actions([

                ActionGroup::make([
                    Action::make('view')
                ->color('primary')
                ->label('View')
                ->icon('heroicon-m-eye')
                ->modalContent(function (Personnel $record) {
                    return view('livewire.personnels.view-personnel', ['record' => $record]);
                })
                ->modalHeading('Details')
                ->modalSubmitAction(false)
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                ->disabledForm()
                 ->slideOver()
                 ->closeModalByClickingAway(true)

                ->modalWidth(MaxWidth::SevenExtraLarge),

                // ->url(function(){
                //     return route('create-student');
                // }),
                EditAction::make()->form(FilamentForm::staffForm())  ->modalWidth(MaxWidth::SevenExtraLarge),
                Tables\Actions\DeleteAction::make()
                
                ])->tooltip('MANAGEMENT'),

            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {
        return view('livewire.personnels.list-personnels');
    }
}
