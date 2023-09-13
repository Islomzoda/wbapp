<?php

namespace App\MoonShine\Resources;

use App\Models\MarketAccess;
use Illuminate\Database\Eloquent\Model;
use App\Models\WBProduct;

use MoonShine\Fields\Text;
use MoonShine\Filters\SwitchBooleanFilter;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use Illuminate\Contracts\Database\Eloquent\Builder;
class WBProductResource extends Resource
{
	public static string $model = WBProduct::class;

	public static string $title = 'Список товаров';
    public static array $activeActions = [];

	public function fields(): array
	{
		return [
            ID::make()->sortable(),
		    Text::make(
                'SKU', 'vendor_code')->disabled(),
            Text::make(
                'BARCODE', 'nm_id'
            )->disabled(),

        ];
	}
    public function query(): Builder
    {
        return parent::query()
            ->when(auth()->user()->exists, function ($q){
                $markets = MarketAccess::where('user_id', auth()->user()->id)->where('access', true)->get()->pluck('brand_id');
                if (!empty($markets)){
                      return $q->whereIn('brand_id', $markets);

                }
                return false;

            });
    }

    public function rules(Model $item): array
	{
	    return [];
    }

    public function search(): array
    {
        return ['vendor_code'];
    }

    public function filters(): array
    {
        return [
            SwitchBooleanFilter::make('Опубликованные', 'is_prohibited')
        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
