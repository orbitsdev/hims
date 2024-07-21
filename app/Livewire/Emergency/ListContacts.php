<?php

namespace App\Livewire\Emergency;

use Filament\Tables;
use Livewire\Component;
use Filament\Tables\Table;
use App\Models\EmergencyContact;
use Illuminate\Contracts\View\View;
use Filament\Forms\Contracts\HasForms;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Contracts\HasTable;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Components\TextInput;
use Filament\Tables\Columns\ImageColumn;
use Filament\Forms\Components\FileUpload;
use Filament\Tables\Actions\CreateAction;
use Illuminate\Database\Eloquent\Builder;
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
          
            FileUpload::make('image')
                    ->disk('public')
                    ->directory('contacts')
                    ->image()
                    ->imageEditor()
                    // ->required()
                    ->columnSpanFull()
                    ->label('PHOTO')
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
                
            ])
            ->filters([
                
            ])
            ->headerActions([
               
                CreateAction::make('create')
                ->mutateFormDataUsing(function (array $data): array {
             
                    return $data;
                })
                ->icon('heroicon-s-sparkles')
                ->label('New Conract')
                ->form($this->emergencyContactForm())->modalWidth('7xl')
                ->createAnother(false)
        ])
        ->actions([
            //edit actions
            Tables\Actions\EditAction::make()->button()->form($this->emergencyContactForm())->modalWidth('7xl'),
            Tables\Actions\DeleteAction::make()->button(),
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
