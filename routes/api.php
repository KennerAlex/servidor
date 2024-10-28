<?php

use App\Http\Controllers\CategoriaProductoController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\UsuarioController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('login', [UsuarioController::class,'store']);
Route:: get('/login',[UsuarioController::class,'index']);
Route:: get('/login/{email}',[UsuarioController::class,'verificaemail']);
Route:: get('/login/{email}/{password}',[UsuarioController::class,'verificaclave']);
Route::resource('/listado', ClienteController::class);
Route::resource('/productos', ProductoController::class);
Route::resource('/categoria', CategoriaProductoController::class);


