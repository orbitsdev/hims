<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Personnel;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class PersonnelList extends Component implements HasForms, HasTable
{
    use InteractsWithForms, InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Personnel::query())
            ->columns([
                ImageColumn::make('user.profile_photo_path')
                ->disk('public')
                ->label('Profile')
                ->width(60)->height(60)

                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab()
                ->circular(),

                Tables\Columns\TextColumn::make('user.name')
                    ->searchable()
                    ->label('User'),

                Tables\Columns\TextColumn::make('department.name')
                    ->label('Department')
                    ->searchable(),
            ])
            ->filters([
                SelectFilter::make('department')
                    ->relationship('department', 'name')
                    ->searchable()
                    ->preload(),
            ], layout: FiltersLayout::AboveContent)
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

                    Action::make('print')
                        ->size('lg')
                        ->icon('heroicon-s-printer')
                        ->label('Print Details')
                        ->openUrlInNewTab()
                        ->url(fn (Model $record) => route('print-personnel', ['record' => $record])),


                        Action::make('View Medical Record')
                    ->icon('heroicon-s-printer')
            ->label('Medical Records')
                    ->modalContent(function (Personnel $record) {
                        return view('livewire.all-medical-recors', ['record' => $record->user]);
                    })
                    ->modalHeading('Medical Records')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->disabledForm()

                     ->closeModalByClickingAway(true)

                    ->modalWidth('7xl'),

                        ])->tooltip('Management'),


            ])
            ->bulkActions([]);
    }

    public function render()
    {
        return view('livewire.personnel-list');
    }
}
