<?php

use App\Http\Controllers\HomeControllers;
use App\Http\Controllers\News\NGSController;
use App\Http\Controllers\News\RiaNewsController;
use App\Http\Controllers\Shops\SlamjamShopController;
use App\Http\Controllers\Forecasts\YandexWeatherController;
use Illuminate\Support\Facades\Route;


Route::get('/', [HomeControllers::class, 'index'])->name('home');
Route::get('/catch', [HomeControllers::class, 'fetchData'])->name('fetch.data');
Route::group(['namespace' => 'News', 'prefix' => 'news'], function () {
    Route::get('/ngsnews', [NGSController::class, 'fetchData'])->name('ngsnews');
    Route::get('/rianews', [RiaNewsController::class, 'fetchData'])->name('rianews');
});
Route::group(['namespace' => 'Shops', 'prefix' => 'shops'], function () {
    Route::get('/slamjam', [SlamjamShopController::class, 'fetchData'])->name('slamjam');
});
Route::group(['namespace' => 'Forecasts', 'prefix' => 'forecasts'], function () {
    Route::get('/yandexweather', [YandexWeatherController::class, 'fetchData'])->name('yandexweather');
});
