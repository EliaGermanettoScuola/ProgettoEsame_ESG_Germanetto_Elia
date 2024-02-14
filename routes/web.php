<?php

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

Route::get('/', function () {
    header('Access-Control-Allow-Origin: *');
    return view('welcome');
});

Route::get('/test', function () {
    header('Access-Control-Allow-Origin: *');
    return "CIAO SONO LA PAGINA TEST";
});
