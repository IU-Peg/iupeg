<?php

use App\Http\Controllers\Cart\CartController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::group(["prefix" => "cart"], function(){
    Route::post("create", [CartController::class, "create_cart"]);
    Route::post("get", [CartController::class, "get_cart"]);
    Route::post("remove", [CartController::class, "remove_cart"]);

    // ITEMS
    Route::group(["prefix" => "item"], function (){
        Route::post("add", [CartController::class, "add_item"]);
    });
});

Route::post("omieAPI/products/get", [\App\Http\Controllers\API\ERP\Omie\OmieController::class, "syncProducts"]);

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
