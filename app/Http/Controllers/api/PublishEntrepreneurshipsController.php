<?php

namespace App\Http\Controllers\api;

use App\Models\PublishEntrepreneurships;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishEntrepreneurshipsController extends Controller
{
    public function index()
    {
        $publishEntrepreneurships = PublishEntrepreneurships::all();
        return response()->json($publishEntrepreneurships, 200);
    }

    public function store(Request $request)
    {
        // Datos mínimos para probar la creación del registro
        $data = $request->all();

        try {
            $entrepreneurship = PublishEntrepreneurships::create([
                'name' => $data['name'] ?? 'Nombre de prueba',
                'slogan' => $data['slogan'] ?? 'Slogan de prueba',
                'category' => $data['category'] ?? 'Categoría de prueba',
                'general_description' => $data['general_description'] ?? 'Descripción general de prueba',
                'logo_path' => $data['logo_path'] ?? 'https://via.placeholder.com/150', // URL como string
                'background' => $data['background'] ?? 'https://via.placeholder.com/300', // URL como string
                'name_products' => json_encode($data['name_products'] ?? ['Producto de prueba']), // Guardar como JSON
                'product_images' => json_encode($data['product_images'] ?? ['https://via.placeholder.com/150']), // Guardar como JSON
                'product_descriptions' => json_encode($data['product_descriptions'] ?? ['Descripción de prueba']), // Guardar como JSON
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
            $publishEntrepreneurship = PublishEntrepreneurships::findOrFail($id);
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
            $publishEntrepreneurship = PublishEntrepreneurships::findOrFail($id);
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
            $publishEntrepreneurship = PublishEntrepreneurships::findOrFail($id);
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
