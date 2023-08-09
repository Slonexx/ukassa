<?php

use App\Http\Controllers\installOrDeleteController;
use App\Http\Controllers\TicketController;
use App\Http\Controllers\WebhookMSController;
use Illuminate\Support\Facades\Route;

Route::post('/ticket',[TicketController::class,'initTicket']);

Route::post('/installOfDelete',[installOrDeleteController::class,'insert']);



Route::post('/webhook/customerorder/',[WebhookMSController::class, 'customerorder']);
Route::post('/webhook/demand/',[WebhookMSController::class, 'customerorder']);
Route::post('/webhook/salesreturn/',[WebhookMSController::class, 'customerorder']);
