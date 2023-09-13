<?php

namespace App\MoonShine\Resources;

use Illuminate\Database\Eloquent\Model;
use App\Models\MarketAccess;
use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class MarketAccessResource extends Resource
{
	public static string $model = MarketAccess::class;

    public static bool $withPolicy = true;

    public static string $title = 'Доступ к Магазинам';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            BelongsTo::make('Пользователи','users', 'name')->searchable(),
            BelongsTo::make('Магазины','markets', 'name')->searchable(),
            SwitchBoolean::make('Доступ', 'access')
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['id'];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
