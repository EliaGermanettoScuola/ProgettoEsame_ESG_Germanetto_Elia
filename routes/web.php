<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AziendeController;
use App\Http\Controllers\SessionController;


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


Route::get('/get-csrf-token', function () {
    return response()->json(['csrf_token' => csrf_token()]);
});

Route::post('/registrazione', [AziendeController::class, 'registrazione']);

Route::post('/login', [AziendeController::class, 'login']);

Route::get('/getSession', [SessionController::class, 'getSession']);

route::post('/createSession', [SessionController::class, 'CreateSession']);

route::delete('/destroySession', [SessionController::class, 'destroySession']);

route::get('/getSessionInfo', [SessionController::class, 'getSessionInfo']);