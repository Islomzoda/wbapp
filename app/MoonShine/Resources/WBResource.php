<?php

namespace App\MoonShine\Resources;

use App\Services\WBService;
use Illuminate\Database\Eloquent\Model;
use App\Models\WB;

use MoonShine\Decorations\Button;
use MoonShine\Fields\Text;
use MoonShine\FormActions\FormAction;
use MoonShine\ItemActions\ItemAction;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;

class WBResource extends Resource
{
	public static string $model = WB::class;

	public static string $title = 'WBS';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('ИД магазина', 'brand_id'),
            Text::make('Название', 'name'),
            Text::make('FBO API ключ', 'fbo_api_key')->hideOnIndex(),
            Text::make('FBS API ключ', 'fbs_api_key')->hideOnIndex(),
            Text::make('ADS API ключ', 'ads_api_key')->hideOnIndex(),
        ];
	}

	public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return [
            'name'
        ];
    }

    public function filters(): array
    {
        return [];
    }

    public function actions(): array
    {
        return [

        ];
    }
    public function itemActions(): array
    {
        return [
            ItemAction::make('Загрузкить продукты', function (Model $item) {
                  WBService::importProducts($item->brand_id);
            }, 'Продукты загружены')
        ];
    }
}
