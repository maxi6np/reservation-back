<?php

use App\Http\Controllers\API\ExampleController;
use App\Http\Controllers\API\ReservaController;
use Illuminate\Support\Facades\Route;



Route::get('/index', [ExampleController::class, 'index'])->name('index');

Route::get('/getReservas',[ReservaController::class, 'index'])->name('getReservas');
Route::post('/createReserva',[ReservaController::class, 'store'])->name('createReserva');
Route::put('/updateReserva',[ReservaController::class, 'update'])->name('updateReserva');
Route::delete('/deleteReserva/{id_reserva}',[ReservaController::class, 'destroy'])->name('deleteReserva');
