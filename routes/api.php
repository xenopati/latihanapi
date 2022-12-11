<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\ApiController;

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

Route::get('/test',function(){
    return response()->json([
        'success'=>true, 
        'message'=>'ok'
    ]);
});

Route::get('get-tests', [ApiController::class, 'index']);

Route::post('store-tests', [ApiController::class, 'store']);

Route::put('edit-tests/{id}', [ApiController::class, 'update']);

Route::delete('delete-tests/{id}', [ApiController::class, 'delete']);

Route::post('filter-tests', [ApiController::class, 'filter']);

Route::get('get-paging', [ApiController::class, 'index_paging']);

Route::post('register', [ApiController::class, 'register']);