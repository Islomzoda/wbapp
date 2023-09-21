<?php

namespace App\Console\Commands;

use App\Models\WBProductKeyword;
use Illuminate\Console\Command;

class UpdateFalseCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'update:false';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $ids = WBProductKeyword::all()->pluck('id');
        WBProductKeyword::whereIn('id', $ids)->update(['updated' => false]);
    }
}
