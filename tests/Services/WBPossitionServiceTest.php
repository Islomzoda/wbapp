<?php

namespace Tests\Services;

use App\Services\WBPossitionService;
use Tests\TestCase;

class WBPossitionServiceTest extends TestCase
{

    public function testGet()
    {
        WBPossitionService::get([],'896603');
    }
}
