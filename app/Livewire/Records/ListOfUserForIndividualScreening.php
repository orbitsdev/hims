<?php

namespace App\Livewire\Records;

use App\Models\User;
use Filament\Tables;
use App\Models\Record;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Tables\Actions\Action;

use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\FilamentForm;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\EditAction;
use Filament\Tables\Columns\ViewColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
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
            ->query(User::query()->notAdmin()->hasPersonalDetails()->noRecordInThisAcademicYearAndSemester($this->record)->orderBy('name'))
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
                     ->searchable()->label('ACCOUNT'),
                // Tables\Columns\TextColumn::make('name')
                //     ->searchable(),


                // Tables\Columns\TextColumn::make('name')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('username')
                //     ->searchable(),
                // Tables\Columns\TextColumn::make('email')
                //     ->searchable(),

                ViewColumn::make('first_name')->view('tables.columns.user-first-name')->label('FIRST NAME')
                ->searchable(query: function (Builder $query, string $search, ?Model $record) : Builder {
               
                    return $query->personalDetailsSearch($search);
                   
                                   
                }),
                
                ViewColumn::make('last_name')->view('tables.columns.user-last-name')->label('LAST NAME'),
                ViewColumn::make('middle_name')->view('tables.columns.user-middle-name')->label('MIDDLE NAME'),

                Tables\Columns\TextColumn::make('role')->label('Role')
                    ->color(fn (string $state): string => match ($state) {
                        User::ADMIN => 'primary',
                        User::PERSONNEL => 'info',
                        User::STAFF => 'warning',
                        User::STUDENT => 'success',
                        default => 'gray',
                    })
                    ->searchable()->label('ROLE'),


                ViewColumn::make('department')->view('tables.columns.user-department')->label('DEPARTMENT'),
                
                // ViewColumn::make('status')->view('tables.columns.medical-status-column')->label('MEDICAL STATUS'),


            ])
            ->filters([
                // SelectFilter::make('role')
                // ->label('Role')
                //     ->options(User::ROLES),

            ], layout: FiltersLayout::AboveContent)
            ->actions([

                Action::make('edit')
            
                ->size('lg')
                ->button()
                ->color('primary')
                ->label('CREATE MEDICAL RECORD')
                ->fillForm([
                    'name' => fake()->sentence(),
                   
                ])
                ->modalWidth('7xl')
                
                // ->form(FilamentForm::medicalForm())
                
               
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
