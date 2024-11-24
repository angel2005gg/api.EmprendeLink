<?php

use App\Http\Controllers\api\ConnectionController;
use App\Http\Controllers\api\ReviewController;
use App\Http\Controllers\api\EntrepreneurController;
use App\Http\Controllers\api\EntrepreneurListController;
use App\Http\Controllers\api\MyentrepreneurshipController;
use App\Http\Controllers\api\EntrepreneurshipController;
use App\Http\Controllers\api\PublishEntrepreneurshipsController;

use App\Http\Controllers\api\InvestorController;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

    Route::get('/prueba', function () {
        return 'prueba 12kk';
    });


// ruta que necesito: http://127.0.0.1:8000/api/investors/1?included=entrepreneurs

// Route::get('/investors', [App\Http\Controllers\Api\InvestorController::class, 'index'])->name('api.investors.index');
Route::get('/prueba', function () {
    return 'pruebas pipi';
});


Route::controller(InvestorController::class)->group(function () {
    Route::get('/investors', 'index')->name('api.investors.index');
    Route::post('/investor', 'store')->name('api.investors.store');
    Route::get('/investors/{investor}', 'show')->name('api.investors.show');
    Route::put('/investors/{investor}', 'update')->name('api.investors.update');
    Route::delete('/investors/{investor}', 'destroy')->name('api.investors.destroy');
});

    Route::get('publicare', [PublishEntrepreneurshipsController::class,'index'])->name('api.publish_Entrepreneurships.index');
    Route::post('publicare', [PublishEntrepreneurshipsController::class,'store'])->name('api.publish_Entrepreneurships.store');
    Route::get('publicare/{publishEntrepreneurship}', [PublishEntrepreneurshipsController::class,'show'])->name('api.publish_Entrepreneurships.show');
    Route::put('publicare/{publishEntrepreneurship}', [PublishEntrepreneurshipsController::class,'update'])->name('api.publish_Entrepreneurships.update');
    Route::delete('publicare/{publishEntrepreneurship}', [PublishEntrepreneurshipsController::class,'destroy'])->name('api.publish_Entrepreneurships.delete');


    Route::get('review', [ReviewController::class,'index'])->name('api.reviews.index');
    Route::post('review', [ReviewController::class,'store'])->name('api.reviews.store');
    Route::get('review/{review}', [ReviewController::class,'show'])->name('api.reviews.show');
    Route::put('review/{review}', [ReviewController::class,'update'])->name('api.reviews.update');
    Route::delete('review/{review}', [ReviewController::class,'destroy'])->name('api.reviews.delete');

    Route::get('Entrepreneur', [EntrepreneurController::class, 'index'])->name('api.Entrepreneurs.index');
    Route::post('Entrepreneurs', [EntrepreneurController::class, 'store'])->name('api.Entrepreneurs.store');
    Route::get('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'show'])->name('api.Entrepreneurs.show');
    Route::put('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'update'])->name('api.Entrepreneurs.update');
    Route::delete('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'destroy'])->name('api.Entrepreneurs.delete');

    Route::get('entrepreneurList', [EntrepreneurListController::class, 'index'])->name('api.entrepreneurLists.index');
    Route::post('entrepreneurLists', [EntrepreneurListController::class, 'store'])->name('api.entrepreneurLists.store');
    Route::get('entrepreneurLists/{entrepreneurList}', [EntrepreneurListController::class, 'show'])->name('api.entrepreneurLists.show');
    Route::put('entrepreneurLists/{entrepreneurList}', [EntrepreneurListController::class, 'update'])->name('api.entrepreneurLists.update');
    Route::delete('entrepreneurLists/{entrepreneurList}', [EntrepreneurListController::class, 'destroy'])->name('api.entrepreneurLists.delete');




    // esta es la ruta que necesito para el scope de connection http://127.0.0.1:8000/api/connection/?included=entrepreneur,investor
    Route::get('connection', [ConnectionController::class, 'index'])->name('api.connection.index');
    Route::post('connections', [ConnectionController::class, 'store'])->name('api.connection.store');
    Route::get('connection/{connection}', [ConnectionController::class, 'show'])->name('api.connection.show');
    Route::put('connection/{connection}', [ConnectionController::class,'update'])->name('api.connection.update');
    Route::delete('connection/{connection}', [ConnectionController::class,'destroy'])->name('api.connection.delete');


    Route::prefix(prefix: 'review')->group(function(){
        Route::post('/create',[ReviewController::class,'store']);
        Route::get('/listar',[ReviewController::class,'index']);
        Route::get('/show/{id}',[ReviewController::class,'show']);
        Route::put('/update/{create_review}',[ReviewController::class,'update']);
        Route::delete('/delete/{create_review}',[ReviewController::class,'destroy']);
    });

    // // Route::prefix(prefix: 'investors')->group(function(){
    //     Route::post('/create',[InvestorController::class,'store']);
    //     Route::get('/investors_listar',[InvestorController::class,'index']);
    //     Route::get('/show/{id}',[InvestorController::class,'show']);
    //     Route::put('/update/{connection}',[InvestorController::class,'update']);
    //     Route::delete('/delete/{connection}',[InvestorController::class,'destroy']);
    // // });

    // Route::post('/create',[EntrepreneurController::class,'store']);
    // Route::get('/entrepeneur_listar',[EntrepreneurController::class,'index']);
    // Route::get('/show/{id}',[EntrepreneurController::class,'show']);
    // Route::put('/update/{connection}',[EntrepreneurController::class,'update']);
    // Route::delete('/delete/{connection}',[EntrepreneurController::class,'destroy']);









// Rutas para Myentrepreneurship
Route::get('myentrepreneurships', [MyentrepreneurshipController::class, 'index'])->name('api.myentrepreneurships.index');
Route::post('myentrepreneurship', [MyentrepreneurshipController::class, 'store'])->name('api.myentrepreneurships.store');
Route::get('myentrepreneurships/{myentrepreneurship}', [MyentrepreneurshipController::class, 'show'])->name('api.myentrepreneurships.show');
Route::put('myentrepreneurships/{myentrepreneurship}', [MyentrepreneurshipController::class, 'update'])->name('api.myentrepreneurships.update');
Route::delete('myentrepreneurships/{myentrepreneurship}', [MyentrepreneurshipController::class, 'destroy'])->name('api.myentrepreneurships.delete');


// Rutas para Entrepreneurship
Route::get('entrepreneurships', [EntrepreneurshipController::class, 'index'])->name('api.entrepreneurships.index');
Route::post('entrepreneurships', [EntrepreneurshipController::class, 'store'])->name('api.entrepreneurships.store');
Route::get('entrepreneurships/{entrepreneurship}', [EntrepreneurshipController::class, 'show'])->name('api.entrepreneurships.show');
Route::put('entrepreneurships/{entrepreneurship}', [EntrepreneurshipController::class, 'update'])->name('api.entrepreneurships.update');
Route::delete('entrepreneurships/{entrepreneurship}', [EntrepreneurshipController::class, 'destroy'])->name('api.entrepreneurships.delete');

