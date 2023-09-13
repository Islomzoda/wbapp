<?php

namespace App\MoonShine\Resources;

use App\Models\MarketAccess;
use Illuminate\Database\Eloquent\Model;
use App\Models\WBProductPossition;

use MoonShine\Fields\NoInput;
use MoonShine\Fields\Number;
use MoonShine\Fields\Text;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use Illuminate\Contracts\Database\Eloquent\Builder;
class WBProductPossitionResource extends Resource
{
	public static string $model = WBProductPossition::class;

	public static string $title = 'Позиции';
    public static string $orderType = 'ASC'; // Default sort type
    public static array $activeActions = [];
    public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Text::make('SKU', 'sku'),
            Text::make('Ключевое слово', 'keyword'),
            NoInput::make('Позиция', 'position')->badge(function ($item) {
                if ($item->ads == 1) return "blue";
                if($item->position <= 10) {
                    return 'green';
                }elseif ($item->position <= 50) {
                    return 'yellow';
                }else{
                    return 'red';
                }
            })->sortable(),
            NoInput::make('Реклама', 'ads', function ($item){
                if ($item->ads == 0){
                    return 'Органика';
                }elseif ($item->ads == 1){
                    return 'Бустер';
                }
            })->badge(function ($item) {
                if ($item->ads == 1) return "blue";
                return 'gray';
            }),

        ];
	}

    public function query(): Builder
    {
        return parent::query()
            ->when(auth()->user()->exists, function ($q){
                $markets = MarketAccess::where('user_id', auth()->user()->id)->where('access', true)->get()->pluck('brand_id');
                if (!empty($markets)){
                    return $q->whereIn('brand_id', $markets)
                                ->where('position_date', today()->format('d-m-Y'));

                }
                return false;

            });
    }

    public function rules(Model $item): array
	{
	    return [

        ];
    }

//    public function trClass(Model $item, int $index): string
//    {
//        if ($item->ads == 1) return "Blue";
//        if($item->position <= 10) {
//            return 'green';
//        }elseif ($item->position <= 50) {
//            return 'yellow';
//        }else{
//            return 'red';
//        }
//
//        return parent::trClass($item, $index);
//    }

    public function search(): array
    {
        return ['sku'];
    }

    public function filters(): array
    {
        return [

        ];
    }

    public function actions(): array
    {
        return [
            FiltersAction::make(trans('moonshine::ui.filters')),
        ];
    }
}
