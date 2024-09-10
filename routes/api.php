<?php

use App\Http\Controllers\Api\ConnectionController;
use App\Http\Controllers\Api\CreateReviewsController;
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


    // Route::get('usuarios_invercionistas', [UsuariosInvercionistasController::class,'index'])->name('api.usuarios_invercionistas.index');
    // Route::post('usuarios_invercionistas', [UsuariosInvercionistasController::class,'store'])->name('api.usuarios_invercionistas.store');
    // Route::get('usuarios_invercionistas/{usuarios_invercionistas}', [UsuariosInvercionistasController::class,'show'])->name('api.usuarios_invercionistas.show');
    // Route::put('usuarios_invercionistas/{usuarios_invercionistas}', [UsuariosInvercionistasController::class,'update'])->name('api.usuarios_invercionistas.update');
    // Route::delete('usuarios_invercionistas/{usuarios_invercionistas}', [UsuariosInvercionistasController::class,'destroy'])->name('api.usuarios_invercionistas.delete');

    // Route::get('emprendimientos', [EmprendimientoController::class, 'index'])->name('api.emprendimientos.index');
    // Route::post('emprendimientos', [EmprendimientoController::class, 'store'])->name('api.emprendimientos.store');
    // Route::get('emprendimientos/{emprendimiento}', [EmprendimientoController::class, 'show'])->name('api.emprendimientos.show');
    // Route::put('emprendimientos/{emprendimiento}', [EmprendimientoController::class, 'update'])->name('api.emprendimientos.update');
    // Route::delete('emprendimientos/{emprendimiento}', [EmprendimientoController::class, 'destroy'])->name('api.emprendimientos.destroy');

    // Route::get('/prueba', function () {
    //     return 'prueba 1234';
    // });

    // Route::get('emprendimientos', [EmprendimientoController::class, 'index'])->name('api.emprendimientos.index');
    // Route::post('emprendimientos', [EmprendimientoController::class, 'store'])->name('api.emprendimientos.store');
    // Route::get('emprendimientos/{emprendimiento}', [EmprendimientoController::class, 'show'])->name('api.emprendimientos.show');
    // Route::put('emprendimientos/{emprendimiento}', [EmprendimientoController::class, 'update'])->name('api.emprendimientos.update');
    // Route::delete('emprendimientos/{emprendimiento}', [EmprendimientoController::class, 'destroy'])->name('api.emprendimientos.destroy');

    // Route::get('inversionistas', [InversionistaController::class, 'index'])->name('api.inversionistas.index');
    // Route::post('inversionistas', [InversionistaController::class, 'store'])->name('api.inversionistas.store');
    // Route::get('inversionistas/{inversionista}', [InversionistaController::class, 'show'])->name('api.inversionistas.show');
    // Route::put('inversionistas/{inversionista}', [InversionistaController::class, 'update'])->name('api.inversionistas.update');
    // Route::delete('inversionistas/{inversionista}', [InversionistaController::class, 'destroy'])->name('api.inversionistas.destroy');


    // Route::get('publicare', [PublicarEmprendimientoController::class,'index'])->name('api.publicar__emprendimientos.index');
    // Route::post('publicare', [PublicarEmprendimientoController::class,'store'])->name('api.publicar__emprendimientos.store');
    // Route::get('publicare/{publicar_emprendimiento}', [PublicarEmprendimientoController::class,'show'])->name('api.publicar__emprendimientos.show');
    // Route::put('publicare/{publicar_emprendimiento}', [PublicarEmprendimientoController::class,'update'])->name('api.publicar__emprendimientos.update');
    // Route::delete('publicare/{publicar_emprendimiento}', [PublicarEmprendimientoController::class,'destroy'])->name('api.publicar__emprendimientos.delete');


    // Route::get('resena', [ResenaController::class,'index'])->name('api.resenas.index');
    // Route::post('resena', [ResenaController::class,'store'])->name('api.resenas.store');
    // Route::get('resena/{resena}', [ResenaController::class,'show'])->name('api.resenas.show');
    // Route::put('resena/{resena}', [ResenaController::class,'update'])->name('api.resenas.update');
    // Route::delete('resena/{resena}', [ResenaController::class,'destroy'])->name('api.resenas.delete');

    // Route::get('cear_resena', [CrearResenasController::class,'index'])->name('api.crear_resenas.index');
    // Route::post('cear_resena', [CrearResenasController::class,'store'])->name('api.crear_resenas.store');
    // Route::get('cear_resena/{cear_resena}', [CrearResenasController::class,'show'])->name('api.crear_resenas.show');
    // Route::put('cear_resena/{cear_resena}', [CrearResenasController::class,'update'])->name('api.crear_resenas.update');
    // Route::delete('cear_resena/{cear_resena}', [CrearResenasController::class,'destroy'])->name('api.crear_resenas.delete');

    
 // Route::get('Entrepreneurs', [EntrepreneurController::class, 'index'])->name('api.Entrepreneurs.index');
// Route::post('Entrepreneurs', [EntrepreneurController::class, 'store'])->name('api.Entrepreneurs.store');
// Route::get('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'show'])->name('api.Entrepreneurs.show');
// Route::put('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'update'])->name('api.Entrepreneurs.update');
// Route::delete('Entrepreneurs/{Entrepreneur}', [EntrepreneurController::class, 'destroy'])->name('api.Entrepreneurs.delete');

// Route::get('EntrepreneurList', [EntrepreneurListController::class, 'index'])->name('api.EntrepreneurList.index');
// Route::post('EntrepreneurList', [EntrepreneurListController::class, 'store'])->name('api.EntrepreneurList.store');
// Route::get('EntrepreneurList/{entrepreneurList}', [EntrepreneurListController::class, 'show'])->name('api.EntrepreneurList.show');
// Route::put('EntrepreneurList/{entrepreneurList}', [EntrepreneurListController::class, 'update'])->name('api.EntrepreneurList.update');
// Route::delete('EntrepreneurList/{entrepreneurList}', [EntrepreneurListController::class, 'destroy'])->name('api.EntrepreneurList.delete');

// Route::get('connections', [ConnectionController::class, 'index'])->name('api.connections.index');
// Route::post('connections', [ConnectionController::class, 'store'])->name('api.connections.store');
// Route::get('connections/{connection}', [ConnectionController::class, 'show'])->name('api.connections.show');
// Route::put('connections/{connection}', [ConnectionController::class, 'update'])->name('api.connections.update');
// Route::delete('connections/{connection}', [ConnectionController::class, 'destroy'])->name('api.connections.destroy');


    Route::prefix('review')->group(function(){
        Route::post('/create',[CreateReviewsController::class,'store']);
        Route::get('/listar',[CreateReviewsController::class,'index']);
        Route::get('/show/{id}',[CreateReviewsController::class,'show']);
        Route::put('/update/{create_review}',[CreateReviewsController::class,'update']);
        Route::delete('/delete/{create_review}',[CreateReviewsController::class,'destroy']);
    });


    Route::prefix('connection')->group(function(){
        Route::post('/create',[ConnectionController::class,'store']);
        Route::get('/listar',[ConnectionController::class,'index']);
        Route::get('/show/{id}',[ConnectionController::class,'show']);
        Route::put('/update/{Connection}',[ConnectionController::class,'update']);
        Route::delete('/delete/{Connection}',[ConnectionController::class,'destroy']);
    });
