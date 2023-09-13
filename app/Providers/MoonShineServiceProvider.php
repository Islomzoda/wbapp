<?php

namespace App\Providers;

use App\MoonShine\Resources\MarketAccessResource;
use App\MoonShine\Resources\WBProductKeywordResource;
use App\MoonShine\Resources\WBProductPossitionResource;
use App\MoonShine\Resources\WBProductResource;
use App\MoonShine\Resources\WBResource;
use Illuminate\Support\ServiceProvider;
use MoonShine\MoonShine;
use MoonShine\Menu\MenuGroup;
use MoonShine\Menu\MenuItem;
use MoonShine\Resources\MoonShineUserResource;
use MoonShine\Resources\MoonShineUserRoleResource;

class MoonShineServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        app(MoonShine::class)->menu([
            MenuGroup::make('Пользователи', [
                MenuItem::make('Список', new MoonShineUserResource(), 'users'),
                MenuItem::make('Роли', new MoonShineUserRoleResource()),
            ])->icon('users')->canSee(fn() => auth()->user()->moonshine_user_role_id === 1),
            MenuGroup::make('WB', [
                MenuItem::make('Магазины', new WBResource())->canSee(fn() => auth()->user()->moonshine_user_role_id === 1),
                MenuItem::make('Товары', new WBProductResource()),
                MenuItem::make('Ключевые слова', new WBProductKeywordResource()),
//                MenuItem::make('Ключевые слова', new WBKeywordPage()),

                MenuItem::make('Позиции', new WBProductPossitionResource()),
                MenuItem::make('Доступные Магазины', new MarketAccessResource())->canSee(fn() => auth()->user()->moonshine_user_role_id === 1),

            ])
        ]);
    }
}
