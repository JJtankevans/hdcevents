<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/', [EventController::class, 'index' ]);
Route::get('/events/create', [EventController::class, 'create' ]);
ROute::post('/events',[EventController::class,'store']);

Route::get('/main', function () {

    return view('layouts/main');
});

Route::get('/contact', function () {
    return view('contact');
});


