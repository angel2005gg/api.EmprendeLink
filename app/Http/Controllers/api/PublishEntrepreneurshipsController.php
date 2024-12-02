<?php

namespace App\Http\Controllers\api;

use App\Models\publish_Entrepreneurships;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;

class PublishEntrepreneurshipsController extends Controller
{
    public function index()
    {
        $publishEntrepreneurships = publish_Entrepreneurships::all();
        return response()->json($publishEntrepreneurships, 200);
    }

    public function store(Request $request)
    {
        // Datos mínimos para probar la creación del registro
        $data = $request->all();

        try {
            $entrepreneurship = publish_Entrepreneurships::create([
                'name' => $data['name'] ?? 'Nombre de prueba',
                'slogan' => $data['slogan'] ?? 'Slogan de prueba',
                'category' => $data['category'] ?? 'Categoría de prueba',
                'general_description' => $data['general_description'] ?? 'Descripción general de prueba',
                'logo_path' => $data['logo_path'] ?? 'https://via.placeholder.com/150',
                'background' => $data['background'] ?? 'https://via.placeholder.com/300',
                'name_products' => json_encode($data['name_products'] ?? ['Producto de prueba']),
                'product_images' => json_encode($data['product_images'] ?? ['https://via.placeholder.com/150']),
                'product_descriptions' => json_encode($data['product_descriptions'] ?? ['Descripción de prueba']),
                'entrepreneurs_id' => $data['entrepreneurs_id'] ?? 1,
            ]);

            return response()->json([
                'message' => 'Emprendimiento de prueba creado exitosamente!',
                'data' => $entrepreneurship,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el emprendimiento de prueba.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function show($id)
    {
        try {
            $publishEntrepreneurship = publish_Entrepreneurships::findOrFail($id);
            return response()->json([
                'message' => 'Emprendimiento encontrado.',
                'data' => $publishEntrepreneurship,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Emprendimiento no encontrado.',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $publishEntrepreneurship = publish_Entrepreneurships::findOrFail($id);
            $data = $request->all();

            $publishEntrepreneurship->update([
                'name' => $data['name'] ?? $publishEntrepreneurship->name,
                'slogan' => $data['slogan'] ?? $publishEntrepreneurship->slogan,
                'category' => $data['category'] ?? $publishEntrepreneurship->category,
                'general_description' => $data['general_description'] ?? $publishEntrepreneurship->general_description,
                'logo_path' => $data['logo_path'] ?? $publishEntrepreneurship->logo_path,
                'background' => $data['background'] ?? $publishEntrepreneurship->background,
                'name_products' => json_encode($data['name_products'] ?? json_decode($publishEntrepreneurship->name_products)),
                'product_images' => json_encode($data['product_images'] ?? json_decode($publishEntrepreneurship->product_images)),
                'product_descriptions' => json_encode($data['product_descriptions'] ?? json_decode($publishEntrepreneurship->product_descriptions)),
                'entrepreneurs_id' => $data['entrepreneurs_id'] ?? $publishEntrepreneurship->entrepreneurs_id,
            ]);

            return response()->json([
                'message' => 'Emprendimiento actualizado exitosamente!',
                'data' => $publishEntrepreneurship,
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el emprendimiento.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $publishEntrepreneurship = publish_Entrepreneurships::findOrFail($id);
            $publishEntrepreneurship->delete();

            return response()->json([
                'message' => 'Emprendimiento eliminado exitosamente!',
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al eliminar el emprendimiento.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
