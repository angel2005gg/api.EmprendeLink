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

    
    // Route::get('Emprendedores', [EmprendedorController::class,'index'])->name('api.Emprendedores.index');
    // Route::post('Emprendedores', [EmprendedorController::class,'store'])->name('api.Emprendedores.store');
    // Route::get('Emprendedores/{Emprendedor}', [EmprendedorController::class,'show'])->name('api.Emprendedores.show');
    // Route::put('Emprendedores/{Emprendedor}', [EmprendedorController::class,'update'])->name('api.Emprendedores.update');
    // Route::delete('Emprendedores/{Emprendedor}', [EmprendedorController::class,'destroy'])->name('api.Emprendedores.delete');

    
    // Route::get('usuario_emprendedors', [UsuariosEmprendedorController::class,'index'])->name('api.usuario_emprededors.index');
    // Route::post('usuario_emprendedors', [UsuariosEmprendedorController::class,'store'])->name('api.usuario_emprededor.store');
    // Route::get('usuario_emprendedors/{usuario_emprendedor}', [UsuariosEmprendedorController::class,'show'])->name('api.usuario_emprededor.show');
    // Route::put('usuario_emprendedors/{usuario_emprendedor}', [UsuariosEmprendedorController::class,'update'])->name('api.usuario_emprededor.update');
    // Route::delete('usuario_emprendedors/{usuario_emprendedor}', [UsuariosEmprendedorController::class,'destroy'])->name('api.usuario_emprededor.delete');

    // Route::get('conexiones', [ConexionController::class, 'index'])->name('api.conexiones.index');
    // Route::post('conexiones', [conexionController::class, 'store'])->name('api.conexiones.store');
    // Route::get('conexiones/{conexion}', [conexionController::class, 'show'])->name('api.conexiones.show');
    // Route::put('conexiones/{conexion}', [conexionController::class, 'update'])->name('api.conexiones.update');
    // Route::delete('conexiones/{conexion}', [conexionController::class, 'destroy'])->name('api.conexiones.destroy');

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
