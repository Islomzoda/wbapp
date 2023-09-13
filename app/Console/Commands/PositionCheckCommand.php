<?php

namespace App\Console\Commands;

use App\Jobs\PositionJob;
use App\Models\WBProductKeyword;
use App\Services\WBPossitionService;
use Illuminate\Console\Command;

class PositionCheckCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'position:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Данная команда будет проверять позиции всех ключевых слов';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $keys = WBProductKeyword::where('updated', false)->take(10)->get();
        if (!empty($keys)){
            WBPossitionService::get($keys);
            WBProductKeyword::whereIn('id', $keys->pluck('id'))->update(['updated' => true]);
            PositionJob::dispatch()->delay(now()->addSeconds(10));
        }
    }
}
