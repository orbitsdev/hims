<?php

namespace App\Livewire\Emergency;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\EmergencyContact;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Textarea;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Actions\ActionGroup;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
use Filament\Forms\Components\ToggleButtons;
use Illuminate\Database\Eloquent\Collection;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Tables\Concerns\InteractsWithTable;

class ListContacts extends Component implements HasForms, HasTable
{
    use InteractsWithForms;
    use InteractsWithTable;


    public function emergencyContactForm(): array {
        return [
            TextInput::make('name')->required()->label('NAME')
             ->columnSpanFull(),
            TextInput::make('contact')->required()->label('CONTACT')
             ->columnSpanFull(),
            Textarea::make('address')->required()->label('ADDRESS')
             ->columnSpanFull(),

            FileUpload::make('image')
                    ->disk('public')
                    ->directory('contacts')
                    ->image()
                    ->imageEditor()
                    // ->required()
                    ->columnSpanFull()
                    ->label('PHOTO'),

                    ToggleButtons::make('active')
    ->label('Active')
    ->boolean()
        ];
    }
    public function table(Table $table): Table
    {
        return $table
            ->query(EmergencyContact::query())
            ->columns([

                ImageColumn::make('image')
                ->disk('public')
                ->label('LOGO')
                ->width(60)->height(60)
                ->url(fn (EmergencyContact $record): null|string => $record->image ?  Storage::disk('public')->url($record->image) : null)
                ->defaultImageUrl(url('/images/placeholder-image.jpg'))
                ->openUrlInNewTab()
                ->circular()
                ,
                Tables\Columns\TextColumn::make('name')
                    ->searchable(),

                Tables\Columns\TextColumn::make('contact')
                    ->searchable(),
                Tables\Columns\TextColumn::make('address')
                ->wrap()
                ->searchable(),
                IconColumn::make('active')
    ->boolean(),

            ])
            ->filters([

            ])
            ->headerActions([

                CreateAction::make('create')
                ->size('lg')
                ->mutateFormDataUsing(function (array $data): array {

                    return $data;
                })
                ->modalHeading('CREATE CONTACT')
                ->icon('heroicon-s-plus')

                ->label('New Contact')
                ->form($this->emergencyContactForm())->modalWidth('7xl')
                ->createAnother(false)
        ])
        ->actions([
            ActionGroup::make([
                Tables\Actions\EditAction::make()->form($this->emergencyContactForm())->modalWidth('7xl'),
                Tables\Actions\DeleteAction::make(),
            ]),
            //edit actions

                // ->createAnother(false)
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
        return view('livewire.emergency.list-contacts');
    }
}
