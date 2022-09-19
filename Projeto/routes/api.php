<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

/*
    Rotas que servem para fazer as posatgems, salvando o número do ID delas
*/

Route::post('post',[PostController::class,'store']);
Route::get('post', [PostController::class, 'index']);
Route::get('post/{id}', [PostController::class, 'show']);
Route::post('post/editar/{id}', [Postcontroller::class, 'edit']);
Route::delete('post/deletar/{id}', [PostController::class, 'destroy']);

/*
    Rotas que salvam ou mostram os comentários de uma postagem pelo ID dela
*/

Route::post('post/{id}/comentario', [CommentController::class, 'store']);
Route::get('comentario/{id}', [CommentController::class, 'show']);
Route::get('post/{id}/comentario', [CommentController::class,'index']);
Route::post('comentario/editar/{id}', [CommentController::class,'edit']);
Route::delete('comentario/deletar/{id}', [CommentController::class, 'destroy']);


