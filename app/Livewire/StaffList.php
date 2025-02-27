<?php

namespace App\Livewire;

use Filament\Tables;
use App\Models\Staff;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Filament\Tables\Filters\Filter;
use Filament\Support\Enums\MaxWidth;
use Filament\Forms\Components\Select;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class StaffList extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(Staff::query())
            ->columns([
                ImageColumn::make('user.profile_photo_path')
                ->disk('public')
                ->label('Profile')
                ->width(60)->height(60)

                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab()
                ->circular(),

                Tables\Columns\TextColumn::make('name')->label('NAME')
                    ->searchable(isIndividual: true),

                Tables\Columns\TextColumn::make('position')->label('POSITION')
                    ->searchable(isIndividual: true),

                Tables\Columns\TextColumn::make('department.name')->label('DEPARTMENT')
                    ->searchable(isIndividual: false),

                Tables\Columns\TextColumn::make('phone')->label('PHONE'),

                Tables\Columns\TextColumn::make('user.email')->label('EMAIL')->wrap(),

                Tables\Columns\TextColumn::make('employment_type')->label('EMPLOYMENT TYPE'),

                Tables\Columns\TextColumn::make('status')->label('STATUS')
                    ->formatStateUsing(fn (Staff $record) => $record->status ? 'Active' : 'Inactive')
                    ->color(fn (Staff $record) => $record->status ? 'green' : 'red'),
            ])
            ->filters([
                // SelectFilter::make('department')
                //     ->options(Staff::pluck('department', 'department')->toArray())
                //     ->searchable()
                //     ->preload(),
            ], layout: FiltersLayout::AboveContent)

            ->actions([
                Action::make('view')
                    ->button()
                    ->outlined()
                    ->label('View')
                    ->modalContent(fn (Staff $record) => view('livewire.staffs.view-staff', ['record' => $record]))
                    ->modalHeading('Staff Details')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->disabledForm()
                    ->slideOver()
                    ->closeModalByClickingAway(true)
                    ->modalWidth(MaxWidth::Full),

                Action::make('print')
                    ->button()
                    ->outlined()
                    ->link ()
                    ->icon('heroicon-s-printer')
                    ->label('Print Details')
                    ->openUrlInNewTab(true) // Ensure it opens in a new tab
                    ->url(fn (Model $record) => route('print-staff', ['record' => $record])),

                // Action::make('View Notes')
                //     ->button()
                //     ->outlined()
                //     ->icon('heroicon-s-document-text')
                //     ->label('Staff Notes')
                //     ->modalContent(fn (Staff $record) => view('livewire.staff.notes', ['record' => $record]))
                //     ->modalHeading('Staff Notes')
                //     ->modalSubmitAction(false)
                //     ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                //     ->disabledForm()
                //     ->closeModalByClickingAway(true)
                //     ->modalWidth('7xl'),

                ActionGroup::make([])
                    ->tooltip('MANAGEMENT'),
            ])
            ->bulkActions([]);
    }

    public function render()
    {
        return view('livewire.staff-list');
    }
}
