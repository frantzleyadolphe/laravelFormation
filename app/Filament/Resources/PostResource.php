<?php

namespace App\Filament\Resources;

use Closure;
use Filament\Forms;
use App\Models\Post;
use Filament\Tables;
use Illuminate\Support\Str;
use Filament\Resources\Form;
use Filament\Resources\Table;
use Filament\Resources\Resource;
use Filament\Forms\Components\Card;
use Filament\Tables\Filters\Filter;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Tables\Columns\TextColumn;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\RichEditor;
use Illuminate\Database\Eloquent\Builder;
use Filament\Tables\Columns\BooleanColumn;
use App\Filament\Resources\PostResource\Pages;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Filament\Resources\PostResource\RelationManagers\TagsRelationManager;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-duplicate';

    protected static ?string $navigationGroup = 'Blog';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Card::make()->schema([
                    TextInput::make('title')->reactive()
                    ->afterStateUpdated(function (Closure $set, $state) {
                        $set('slug', Str::slug($state));
                    })->required(),
                    Select::make('category_id')
                    ->relationship('category', 'name'),
                    RichEditor::make('content'),
                TextInput::make('slug')->required()]),
                Toggle::make('is_published')
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                //kod pou w aficher data yo
                TextColumn::make('id')->limit(50)->sortable(),
                TextColumn::make('title')->limit(50)->sortable()->searchable(),
                TextColumn::make('slug')->limit(50),
                BooleanColumn::make('is_published')
            ])
            ->filters([
                //fonksyon sa pemet mwen filtrer tablo an poum jwen tout post ki published yo
                Filter::make('Published')
                ->query(fn (Builder $query): Builder => $query->where('is_published', true)),
                Filter::make('Unpublished')
    ->query(fn (Builder $query): Builder => $query->where('is_published', false))
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
            TagsRelationManager::class
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
