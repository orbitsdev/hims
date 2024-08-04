<?php

namespace App\Livewire\Records;

use App\Models\User;
use Filament\Tables;
use App\Models\Record;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListOfUserForIndividualScreening extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public Record $record;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->noRecordInThisAcademicYearAndSemester($this->record)->orderBy('name'))
            ->columns([

                ImageColumn::make('profile_photo_path')
                    ->disk('public')
                    ->label('Profile')
                    ->width(60)->height(60)
                    ->url(fn (User $record): null|string => $record->profile_photo_path ?  Storage::disk('public')->url($record->profile_photo_path) : null)
                    ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                    ->openUrlInNewTab()
                    ->circular(),
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),


                // Tables\Columns\TextColumn::make('name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('username')
                //     ->searchable(),
                Tables\Columns\TextColumn::make('email')
                    ->searchable(),
                Tables\Columns\TextColumn::make('role')->label('Role')
                    ->color(fn (string $state): string => match ($state) {
                        User::ADMIN => 'primary',
                        User::PERSONNEL => 'info',
                        User::STAFF => 'warning',
                        User::STUDENT => 'success',
                        default => 'gray',
                    })
                    ->searchable(),




                ViewColumn::make('status')->view('tables.columns.medical-status-column')->label('MEDICAL STATUS'),


            ])
            ->filters([
                // SelectFilter::make('role')
                // ->label('Role')
                //     ->options(User::ROLES),

            ], layout: FiltersLayout::AboveContent)
            ->actions([

                Action::make('view')
                ->size('lg')
                ->button()
                ->color('primary')
                ->label('CREATE MEDICAL RECORD')
                
               
                ->url(function(Model $user){
                    return route('medical-record-create', ['record'=> $this->record,'user'=> $user]);
                }),
            
                
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    //
                ]),
            ]);
    }

    public function render(): View
    {

        return view('livewire.records.list-of-user-for-individual-screening');
    }
}
