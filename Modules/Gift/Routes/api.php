<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Routing\Router;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
// 不需要登录即可访问的接口
$router->post('/login', [\Modules\Gift\Http\Controllers\AuthController::class, 'login']);

Route::middleware(['auth.check'])->group(function (Router $router) {
    # 礼物列表
    # 赠送幸运礼物(按组赠送礼物)
    $router->post('/gift/givegroup',[Modules\Gift\Http\Controllers\GiftController::class, 'giveGroupGift']);
    // 需要登录才能访问的接口
    $router->post('/logout', [\Modules\Gift\Http\Controllers\AuthController::class, 'logout'])->middleware('auth.check');
});


