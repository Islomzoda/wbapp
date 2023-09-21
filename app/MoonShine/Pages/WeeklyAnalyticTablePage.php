<?php

namespace App\MoonShine\Pages;

use App\Models\WBProductPossition;
use MoonShine\Resources\CustomPage;

class WeeklyAnalyticTablePage extends CustomPage
{
	public string $title = 'Еженедельная аналитика';

	public string $alias = 'weekly-analytic-table-page';


    public function __construct()
	{
		parent::__construct(
			$this->title(),
			$this->alias(),
			$this->view()
		);
	}

	public function view(): string
	{
		return 'table';
	}

	public function datas(): array
	{
       $keyword = WBProductPossition::where('id', key(request()->all()))->first()->sku;

       $items = WBProductPossition::where('sku', $keyword)->whereBetween('created_at', [today()->subWeek(), now()])->get();
        $dates = [];
        $position = [];
        foreach ($items as $item) {
            $dates = [...$dates, $item->position_date];
            $position = [...$position, $item->position];
        }

		return [
            'dates' => $dates,
            'positions' => $position
        ];
	}
}
