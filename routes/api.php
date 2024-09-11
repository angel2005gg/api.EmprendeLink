<?php

use App\Http\Controllers\Api\ConnectionController;
use App\Http\Controllers\Api\ReviewController;
use App\Http\Controllers\Api\EntrepreneurController;
use App\Http\Controllers\Api\EntrepreneurListController;
use App\Http\Controllers\Api\MyentrepreneurshipController;
use App\Http\Controllers\Api\EntrepreneurshipController;

use App\Http\Controllers\Api\InvestorController;
use App\Http\Controllers\Api\PublishEntrepreneurshipsController;



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

    // Route::get('/prueba', function () {
    //     return 'prueba 1234';
    // });

    Route::get('investors', [InvestorController::class, 'index'])->name('api.investors.index');
Route::post('investors', [InvestorController::class, 'store'])->name('api.investors.store');
Route::get('investors/{investor}', [InvestorController::class, 'show'])->name('api.investors.show');
Route::put('investors/{investor}', [InvestorController::class, 'update'])->name('api.investors.update');
Route::delete('investors/{investor}', [InvestorController::class, 'destroy'])->name('api.investors.destroy');


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
  
    Route::get('Entrepreneurs', [EntrepreneurController::class, 'index'])->name('api.Entrepreneurs.index');
    Route::post('Entrepreneurs', [EntrepreneurController::class, 'store'])->name('api.Entrepreneurs.store');
    Route::get('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'show'])->name('api.Entrepreneurs.show');
    Route::put('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'update'])->name('api.Entrepreneurs.update');
    Route::delete('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'destroy'])->name('api.Entrepreneurs.delete');

    Route::get('entrepreneurLists', [EntrepreneurListController::class, 'index'])->name('api.entrepreneurLists.index');
    Route::post('entrepreneurLists', [EntrepreneurListController::class, 'store'])->name('api.entrepreneurLists.store');
    Route::get('entrepreneurLists/{entrepreneurList}', [EntrepreneurListController::class, 'show'])->name('api.entrepreneurLists.show');
    Route::put('entrepreneurLists/{entrepreneurList}', [EntrepreneurListController::class, 'update'])->name('api.entrepreneurLists.update');
    Route::delete('entrepreneurLists/{entrepreneurList}', [EntrepreneurListController::class, 'destroy'])->name('api.entrepreneurLists.delete');

    Route::get('connections', [ConnectionController::class, 'index'])->name('api.connections.index');
    Route::post('connections', [ConnectionController::class, 'store'])->name('api.connections.store');
    Route::get('connections/{connection}', [ConnectionController::class, 'show'])->name('api.connections.show');
    Route::put('connection/{connection}', [ConnectionController::class,'update'])->name('api.connections.update');
    Route::delete('connection/{connection}', [ConnectionController::class,'destroy'])->name('api.connections.delete');


    Route::prefix(prefix: 'review')->group(function(){
        Route::post('/create',[ReviewController::class,'store']);
        Route::get('/listar',[ReviewController::class,'index']);
        Route::get('/show/{id}',[ReviewController::class,'show']);
        Route::put('/update/{create_review}',[ReviewController::class,'update']);
        Route::delete('/delete/{create_review}',[ReviewController::class,'destroy']);
    });


    Route::prefix('connection')->group(function(){
        Route::post('/create',[ConnectionController::class,'store']);
        Route::get('/listar',[ConnectionController::class,'index']);
        Route::get('/show/{id}',[ConnectionController::class,'show']);
        Route::put('/update/{Connection}',[ConnectionController::class,'update']);
        Route::delete('/delete/{Connection}',[ConnectionController::class,'destroy']);
    });



// Rutas para Myentrepreneurship
Route::get('myentrepreneurships', [MyentrepreneurshipController::class, 'index'])->name('api.myentrepreneurships.index');
Route::post('myentrepreneurships', [MyentrepreneurshipController::class, 'store'])->name('api.myentrepreneurships.store');
Route::get('myentrepreneurships/{myentrepreneurship}', [MyentrepreneurshipController::class, 'show'])->name('api.myentrepreneurships.show');
Route::put('myentrepreneurships/{myentrepreneurship}', [MyentrepreneurshipController::class, 'update'])->name('api.myentrepreneurships.update');
Route::delete('myentrepreneurships/{myentrepreneurship}', [MyentrepreneurshipController::class, 'destroy'])->name('api.myentrepreneurships.delete');


// Rutas para Entrepreneurship
Route::get('entrepreneurships', [EntrepreneurshipController::class, 'index'])->name('api.entrepreneurships.index');
Route::post('entrepreneurships', [EntrepreneurshipController::class, 'store'])->name('api.entrepreneurships.store');
Route::get('entrepreneurships/{entrepreneurship}', [EntrepreneurshipController::class, 'show'])->name('api.entrepreneurships.show');
Route::put('entrepreneurships/{entrepreneurship}', [EntrepreneurshipController::class, 'update'])->name('api.entrepreneurships.update');
Route::delete('entrepreneurships/{entrepreneurship}', [EntrepreneurshipController::class, 'destroy'])->name('api.entrepreneurships.delete');

