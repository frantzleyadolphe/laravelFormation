<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use Filament\Tables;
use App\Models\Category;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Illuminate\Database\Eloquent\Builder;
use App\Filament\Resources\CategoryResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\CategoryResource\RelationManagers;
use App\Filament\Resources\CategoryResource\RelationManagers\PostsRelationManager;

class CategoryResource extends Resource
{
    protected static ?string $model = Category::class;

    protected static ?string $navigationIcon = 'heroicon-o-bookmark';
    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('name')->reactive()
                    ->afterStateUpdated(function (Closure $set, $state)
                    {
                        $set('slug', Str::slug($state));
                    })->required(),
                TextInput::make('slug')->required()])
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //kod pou w aficher data yo
                TextColumn::make('id')->limit(50),
                TextColumn::make('name')->limit(50)->searchable(),
                TextColumn::make('slug')->limit(50)->searchable()
            ])
            ->actions([
                Tables\Actions\EditAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\DeleteBulkAction::make(),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            PostsRelationManager::class,
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListCategories::route('/'),
            'create' => Pages\CreateCategory::route('/create'),
            'edit' => Pages\EditCategory::route('/{record}/edit'),
        ];
    }
}
