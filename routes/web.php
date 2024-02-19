<?php

use App\Http\Controllers\ApiPetController;
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
    return view('welcome');
});

Route::get('/pets', function () {
    return view('pet.main');
})->name('main.pet');

Route::controller(ApiPetController::class)
    ->group(function(){
        
    Route::post('/pets', 'store')->name('store.pet');
    Route::get('/pets/create', 'create')->name('create.pet');
    Route::get('/pets/edit/{id}', 'edit')->name('edit.pet');
    Route::put('/pets/{id}', 'update')->name('update.pet');
    Route::get('/pets/{id}', 'show')->name('show.pet');
    Route::delete('/pets/{id}', 'destroy' )->name('destroy.pet');

});


