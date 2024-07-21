<?php

namespace App\Livewire\Staffs;

use Filament\Tables;
use App\Models\Staff;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\ToggleColumn;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListStaffs extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Staff::query())
            ->columns([
                ImageColumn::make('photo')
                ->disk('public')
                ->label('PHOTO')
                ->width(60)->height(60)
                ->url(fn (Staff $record): null|string => $record->photo ?  Storage::disk('public')->url($record->photo) : null)
                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab()    
                ->circular(),
                // Tables\Columns\TextColumn::make('user.name')->formatStateUsing(function (Model $record) {
                //     return $record->user->fullName() ?? '';
                // })->searchable(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('position')
                ->wrap()
                    ->searchable(),
                // Tables\Columns\TextColumn::make('department')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('phone')
                    ->searchable(),
                // Tables\Columns\TextColumn::make('email')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('employment_type')
                ->wrap()

                    ->searchable(),
                Tables\Columns\TextColumn::make('emergency_contact')
                ->wrap()

                    ->searchable(),
                Tables\Columns\TextColumn::make('started_at')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('end_at')
                    ->date()
                    ->sortable(),
                    ToggleColumn::make('status')
                    
                    ->afterStateUpdated(function ($record, $state) {
                        FilamentForm::notification($state ?'Status set to Active' : 'Status set to in active');
                    })
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
                
            ])
            ->headerActions([
                Action::make('view')
                ->color('primary')
                ->label('New Staff')
                ->icon('heroicon-s-plus')
               
                ->url(function(){
                    return route('staffs-create');
                }),
            ])
            ->actions([
                Action::make('view')
                ->color('success')
                ->icon('heroicon-m-eye')
                ->label('View')
                ->modalContent(function (Staff $record) {
                    return view('livewire.staffs.view-staff', ['record' => $record]);
                })
                ->modalHeading('Details')
                ->modalSubmitAction(false)
                ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                ->disabledForm()
                 ->slideOver()
                 ->closeModalByClickingAway(true)
                 
                
                ->modalWidth(MaxWidth::Full),
                 Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function(Model $record){
                            return route('staffs-edit', ['record'=> $record]);
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
        return view('livewire.staffs.list-staffs');
    }
}
