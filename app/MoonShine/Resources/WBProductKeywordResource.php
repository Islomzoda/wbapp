<?php

namespace App\MoonShine\Resources;

use App\Models\MarketAccess;
use Illuminate\Database\Eloquent\Model;
use App\Models\WBProductKeyword;

use MoonShine\Fields\BelongsTo;
use MoonShine\Fields\NoInput;
use MoonShine\Fields\Number;
use MoonShine\Fields\SwitchBoolean;
use MoonShine\Fields\Text;
use MoonShine\Fields\Textarea;
use MoonShine\Resources\Resource;
use MoonShine\Fields\ID;
use MoonShine\Actions\FiltersAction;
use Illuminate\Contracts\Database\Eloquent\Builder;
class WBProductKeywordResource extends Resource
{
	public static string $model = WBProductKeyword::class;

	public static string $title = 'Ключевые слова';

	public function fields(): array
	{
		return [
		    ID::make()->sortable(),
            Textarea::make('Ключевое слово', 'keyword'),
            BelongsTo::make('Магазин','markets', 'name')->searchable(),
            NoInput::make('Обновлен', 'updated', fn($q) => $q->updated ? "Обновлено" : 'Не Обновлено')->badge(fn($q) => $q->updated ? 'green' : 'red')
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
    protected function afterCreated(Model $item)
    {
        $keywords = explode("\r\n", $item->keyword);
        $model = new WBProductKeyword();
        foreach ($keywords as $keyword){
            $model->firstOrCreate([
                'user_id' => auth()->user()->id,
                'brand_id' => $item->brand_id,
                'keyword' => $keyword
            ],[
                'user_id' => auth()->user()->id,
                'brand_id' => $item->brand_id,
                'keyword' => $keyword
            ]);
        }
        $item->delete();
    }


    public function rules(Model $item): array
	{
	    return [

        ];
    }

    public function search(): array
    {
        return ['id'];
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
