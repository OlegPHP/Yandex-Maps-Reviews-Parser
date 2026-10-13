<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GetCompanyController;

Route::get('/', function () {
    return view('start.start');
});
Route::get('/company/{id}', [GetCompanyController::class, 'showHtml'])->name('company.show');
Route::get('/company', [GetCompanyController::class, 'getId'])->name('company.get');
Route::post('/company', [GetCompanyController::class, 'getId'])->name('company.get');

