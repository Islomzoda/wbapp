<?php

namespace App\MoonShine\Pages;

use MoonShine\Resources\CustomPage;

class WBKeywordPage extends CustomPage
{
	public string $title = 'WBKeywordPages';

	public string $alias = 'wb-keyword-page';

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
		return '';
	}

	public function datas(): array
	{
		return [];
	}
}
