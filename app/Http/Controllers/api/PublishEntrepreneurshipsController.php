<?php
namespace App\Http\Controllers\api;

use App\Models\publish_Entrepreneurships;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PublishEntrepreneurshipsController extends Controller
{
    public function index()
    {
        $publishEntrepreneurships = publish_Entrepreneurships::all();
        return response()->json($publishEntrepreneurships, 200);
    }

    public function store(Request $request)
    {
        // Validaciones
        $validated = $request->validate([
            'name' => 'required|string',
            'slogan' => 'required|string',
            'category' => 'required|string',
            'general_description' => 'required|string',
            'logo_path' => 'nullable|string',  // Puedes enviar un enlace o ruta de logo
            'background' => 'nullable|string',  // Puedes enviar un enlace o ruta de fondo
            'name_products' => 'required|array',
            'product_images' => 'required|array',
            'product_descriptions' => 'required|array',
            'entrepreneurs_id' => 'required|integer',
        ]);

        try {
            $entrepreneurship = publish_Entrepreneurships::create([
                'name' => $validated['name'],
                'slogan' => $validated['slogan'],
                'category' => $validated['category'],
                'general_description' => $validated['general_description'],
                'logo_path' => $validated['logo_path'] ?? 'https://via.placeholder.com/150',
                'background' => $validated['background'] ?? 'https://via.placeholder.com/300',
                'name_products' => json_encode($validated['name_products']),
                'product_images' => json_encode($validated['product_images']),
                'product_descriptions' => json_encode($validated['product_descriptions']),
                'entrepreneurs_id' => $validated['entrepreneurs_id'],
            ]);

            return response()->json([
                'message' => 'Emprendimiento creado exitosamente!',
                'data' => $entrepreneurship,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al crear el emprendimiento.',
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
