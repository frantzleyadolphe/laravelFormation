<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Tag;
use App\Models\Post;
use App\Models\Category;
use Filament\Widgets\StatsOverviewWidget\Card;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;

class StatsOverview extends BaseWidget
{
    protected function getCards(): array
    {
        return [
            Card::make('All post', Post::all()->count()),
            Card::make('All categories', Category::all()->count()),
            Card::make('All tags', Tag::all()->count()),
        ];
    }
}
