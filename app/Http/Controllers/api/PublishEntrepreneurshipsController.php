<?php

namespace App\Http\Controllers\api;

use App\Models\publish_Entrepreneurships;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Storage;

class PublishEntrepreneurshipsController extends Controller
{
    public function index()
    {
        $publishEntrepreneurships = publish_Entrepreneurships::all();
        // $publishEntrepreneurships = PublishEntrepreneurship::included()->get();
        // $categories=Category::included()->filter();
        // $categories=Category::included()->filter()->sort()->get();
        // $categories=Category::included()->filter()->sort()->getOrPaginate();

        $publishEntrepreneurships = publish_Entrepreneurships::included()->get();
        return response()->json($publishEntrepreneurships, 200);

    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'category' => 'required|string',
            'general_description' => 'required|string',
            'logo_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name_products' => 'required|array|min:1',
            'product_images' => 'required|array|min:1',
            'product_descriptions' => 'required|array|min:1',
        ]);

        try {
            // Verifica si los archivos están presentes
            if (!$request->hasFile('logo_path')) {
                return response()->json(['message' => 'Logo file is required'], 400);
            }
            if (!$request->hasFile('background')) {
                return response()->json(['message' => 'Background file is required'], 400);
            }
            if (!$request->hasFile('product_images')) {
                return response()->json(['message' => 'Product images are required'], 400);
            }
    
            // Subir los archivos a Cloudinary
            $logoUrl = Cloudinary::upload($request->file('logo_path')->getRealPath())->getSecurePath();
            $backgroundUrl = Cloudinary::upload($request->file('background')->getRealPath())->getSecurePath();
            $productImages = [];
            foreach ($request->file('product_images') as $image) {
                $productImages[] = Cloudinary::upload($image->getRealPath())->getSecurePath();
            }
    
            // Crear el emprendimiento con los datos validados
            $entrepreneurship = publish_Entrepreneurships::create([
                'name' => $validated['name'],
                'slogan' => $validated['slogan'],
                'category' => $validated['category'],
                'general_description' => $validated['general_description'],
                'logo_path' => $logoUrl,
                'background' => $backgroundUrl,
                'name_products' => json_encode($validated['name_products']),
                'product_images' => json_encode($productImages),
                'product_descriptions' => json_encode($validated['product_descriptions']),
                'entrepreneurs_id' => auth()->id(),
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
        $publishEntrepreneurship = publish_Entrepreneurships::findOrFail($id);

        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'slogan' => 'required|string|max:255',
            'category' => 'required|string',
            'general_description' => 'required|string',
            'logo_path' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'background' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'name_products' => 'required|array|min:1',
            'product_images' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'product_descriptions' => 'required|array|min:1',
        ]);

        try {
            if ($request->hasFile('logo')) {
                $logoUrl = Cloudinary::upload($request->file('logo')->getRealPath())->getSecurePath();
                $publishEntrepreneurship->logo_path = $logoUrl;
            }

            if ($request->hasFile('background')) {
                $backgroundUrl = Cloudinary::upload($request->file('background')->getRealPath())->getSecurePath();
                $publishEntrepreneurship->background = $backgroundUrl;
            }

            $publishEntrepreneurship->update(array_merge(
                $validated,
                ['logo_path' => $logoUrl ?? $publishEntrepreneurship->logo_path]
            ));

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

            Cloudinary::destroy($publishEntrepreneurship->logo_path);
            Cloudinary::destroy($publishEntrepreneurship->background);
            Cloudinary::destroy($publishEntrepreneurship->cover_path);

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