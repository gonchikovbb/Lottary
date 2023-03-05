<?php

use App\Http\Controllers\Api\LotteryGameController;
use App\Http\Controllers\Api\LotteryGameMatchController;
use App\Http\Controllers\Api\LotteryGameMatchUserController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;



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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

# Гость
//Создание пользователя
Route::middleware('guest')->post('/users/register', [UserController::class, 'store']);

//Авторизация. Получение jwt-токена авторизации
Route::group(['middleware' => 'api', 'namespace' => 'App\Http\Controllers\Api', 'prefix' => 'auth'], function ($router) {
    Route::post('login', 'AuthController@login');
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');
});

# Авторизованный пользователь, владелец учетной записи
Route::group([ 'middleware' => 'jwt.auth', 'namespace' => 'User'], function() {
    //Редактирование пользователя
    Route::put('/users/update', [UserController::class, 'update']);

    //Удаление пользователя
    Route::delete('/users/delete', [UserController::class, 'delete']);

    //Запись игрока на лотерейную игру
    Route::post('/lottery_game_match_users', [LotteryGameMatchUserController::class, 'playerRecord']);

});

# Авторизованный администратор
Route::group(['middleware' => 'is_admin', 'namespace' => 'Admin'], function () {

    //Создание матча лотерейной игры
    Route::post('/lottery_game_matches', [LotteryGameMatchController::class, 'create']);

    //Получение списка всех пользователей
    Route::get('/users', [UserController::class, 'index']);

    //Завершение матча лотерейной игры. Обновляется только поле is_finished
    Route::put('/lottery_game_matches', [LotteryGameMatchController::class, 'endOfTheMatch']);
});

# Гость, авторизованный пользователь, администратор
//Получение списка всех матчей по id лотерейной игры
Route::get('/lottery_game_matches/{game_id}', [LotteryGameMatchController::class, 'show']);

//Получение списка всех лотерейных игр
Route::get('/lottery_games', [LotteryGameController::class, 'index']);




