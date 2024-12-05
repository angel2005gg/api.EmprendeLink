<?php

namespace App\Http\Controllers\api;

use App\Models\Myentrepreneurship;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class MyentrepreneurshipController extends Controller
{
    public function index()
    {
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado'], 401);
            }

            // Filtrar los emprendimientos por el ID del usuario
            $myentrepreneurships = Myentrepreneurship::where('entrepreneur_id', $user->id)
                ->included()
                ->filter()
                ->sort()
                ->getOrPaginate();

            return response()->json([
                'message' => 'Emprendimientos recuperados exitosamente',
                'data' => $myentrepreneurships
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al recuperar los emprendimientos',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function store(Request $request)
    {
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado'], 401);
            }

            // Validar los datos
            $request->validate([
                'publish_Entrepreneurships_id' => 'required|exists:publish_Entrepreneurships,id',
            ]);

            // Crear el emprendimiento asociado al usuario
            $myentrepreneurship = Myentrepreneurship::create([
                'entrepreneur_id' => $user->id,
                'publish_Entrepreneurships_id' => $request->input('publish_Entrepreneurships_id'),
            ]);

            return response()->json([
                'message' => 'Emprendimiento agregado a "Mis Emprendimientos" exitosamente',
                'data' => $myentrepreneurship
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al agregar el emprendimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado'], 401);
            }

            // Buscar el emprendimiento del usuario
            $myentrepreneurship = Myentrepreneurship::where('entrepreneur_id', $user->id)
                ->included()
                ->findOrFail($id);

            return response()->json([
                'message' => 'Emprendimiento recuperado exitosamente',
                'data' => $myentrepreneurship
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al recuperar el emprendimiento',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, Myentrepreneurship $myentrepreneurship)
    {
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado'], 401);
            }

            // Verificar que el emprendimiento pertenece al usuario
            if ($myentrepreneurship->entrepreneur_id !== $user->id) {
                return response()->json(['message' => 'No autorizado'], 403);
            }

            // Validar los datos
            $request->validate([
                'publish_Entrepreneurships_id' => 'sometimes|required|exists:publish_Entrepreneurships,id',
            ]);

            // Actualizar el emprendimiento
            $myentrepreneurship->update($request->only(['publish_Entrepreneurships_id']));

            return response()->json([
                'message' => 'Emprendimiento actualizado exitosamente',
                'data' => $myentrepreneurship
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el emprendimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy(Myentrepreneurship $myentrepreneurship)
    {
        try {
            // Obtener el usuario autenticado
            $user = Auth::user();

            if (!$user) {
                return response()->json(['message' => 'Usuario no autenticado'], 401);
            }

            // Verificar que el emprendimiento pertenece al usuario
            if ($myentrepreneurship->entrepreneur_id !== $user->id) {
                return response()->json(['message' => 'No autorizado'], 403);
            }

            // Eliminar el emprendimiento
            $myentrepreneurship->delete();

            return response()->json([
                'message' => 'Emprendimiento eliminado exitosamente'
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el emprendimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
