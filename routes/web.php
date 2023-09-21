<?php

use App\MoonShine\Pages\WeeklyAnalyticTablePage;
use App\Services\WBPossitionService;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/admin/custom_page/weekly-analytic-table-page?{id}', function ($id) {
//
    return  WeeklyAnalyticTablePage::make('Аналитика', 'weekly-analytic-table-page', 'table', ['id' => $id]);
})->name('weekly-analytic-table-page');
Route::get('/test', [WBPossitionService::class, 'test']);
