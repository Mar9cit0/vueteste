<?php
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PagesController;
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

Route::middleware('auth:api')->get('/user', function (Request $request) {
  return $request->user();
});

Route::post('/auth/register', 'App\Http\Controllers\AuthController@postRegister');
Route::post('/auth/login', 'App\Http\Controllers\AuthController@postLogin');
Route::post('/auth/social', 'App\Http\Controllers\AuthController@postSocialLogin');

Route::group(['middleware' => ['auth.jwt']], function () {

  Route::get('/auth/logout', 'App\Http\Controllers\AuthController@logout');
  // Route::post('/lista', 'App\Http\Controllers\TareaController@index');
  // Route::post('/salvar', 'App\Http\Controllers\TareaController@store');
  // Route::post('/mostrar', 'App\Http\Controllers\TareaController@show');
  // Route::post('/update', 'App\Http\Controllers\TareaController@update');
  // Route::post('/eliminar', 'App\Http\Controllers\TareaController@destroy');
  Route::resource('tarea',App\Http\Controllers\TareaController::class)->only(['index','store','show','update','destroy']);

});
