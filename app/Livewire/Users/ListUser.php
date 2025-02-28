<?php

namespace App\Livewire\Users;

use App\Models\User;
use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use Filament\Actions\StaticAction;
use Filament\Tables\Actions\Action;
use Illuminate\Contracts\View\View;
use Filament\Support\Enums\MaxWidth;
use Illuminate\Support\Facades\Hash;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Enums\FiltersLayout;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Database\Eloquent\Builder;
use Rawilk\FilamentPasswordInput\Password;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListUser extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;

    public function table(Table $table): Table
    {
        return $table
            ->query(User::query()->notAdmin()->orderBy('name'))
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
                Tables\Columns\TextColumn::make('username')
                    ->searchable(),
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



                Tables\Columns\TextColumn::make('created_at')->date(),

                // ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                ->date(),
                    // ->toggleable(isToggledHiddenByDefault: true),


            ])
            ->filters([
                SelectFilter::make('role')
                ->label('Role')
                    ->options(User::ROLES),

            ],layout: FiltersLayout::AboveContent)
            ->headerActions([


            Action::make('create')
            ->size('lg')
            ->color('primary')
            ->icon('heroicon-s-user-plus')
            ->button()
            ->url(function(){
                return route('user-create');
            }),


                // CreateAction::make('create')
                // ->mutateFormDataUsing(function (array $data): array {

                //     return $data;
                // })
                // ->icon('heroicon-s-user-plus')
                // ->label('New Account')
                // ->form([







                // // ])
                // //     ->modalWidth('7xl')
                // //     ->createAnother(false)




            ])
            ->actions([
                ActionGroup::make([
                    Action::make('view')
                    ->color('success')
                    ->icon('heroicon-m-eye')
                    ->label('View')
                    ->modalContent(function (User $record) {
                        return view('livewire.user.user-details', ['record' => $record]);
                    })
                    ->modalHeading('Account Details')
                    ->modalSubmitAction(false)
                    ->modalCancelAction(fn (StaticAction $action) => $action->label('Close'))
                    ->disabledForm()
                     ->slideOver()
                     ->closeModalByClickingAway(true)


                    ->modalWidth(MaxWidth::Full),
                     Tables\Actions\Action::make('Edit')->icon('heroicon-s-pencil-square')->url(function(Model $record){
                                return route('user-edit', ['record'=> $record]);
                 })  ,


                    Tables\Actions\DeleteAction::make(),
                ])->tooltip('MANAGEMENT'),


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
        return view('livewire.users.list-user');
    }
}
