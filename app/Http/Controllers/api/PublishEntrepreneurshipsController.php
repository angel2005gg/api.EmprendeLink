<?php
namespace App\Http\Controllers\api;

use App\Models\publish_Entrepreneurships;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;

class PublishEntrepreneurshipsController extends Controller
{
    public function store(Request $request)
{
    // Validaciones
    $validated = $request->validate([
        'name' => 'required|string',
        'slogan' => 'required|string',
        'category' => 'required|string',
        'general_description' => 'required|string',
        'logo_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'background' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'name_products' => 'required|string', // Cambia a string
        'product_images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        'product_descriptions' => 'required|string', // Cambia a string
        'entrepreneurs_id' => 'required|integer|exists:users,id'
    ]);

    try {
        // Cargar imágenes a Cloudinary
        $logoUrl = Cloudinary::upload($request->file('logo_path')->getRealPath(), [
            'folder' => 'entrepreneurships/logos',
        ])->getSecurePath();

        $backgroundUrl = Cloudinary::upload($request->file('background')->getRealPath(), [
            'folder' => 'entrepreneurships/backgrounds',
        ])->getSecurePath();

        // Procesar imágenes de productos
        $productImagesUrls = [];
        if ($request->hasFile('product_images')) {
            foreach ($request->file('product_images') as $productImage) {
                $upload = Cloudinary::upload($productImage->getRealPath(), [
                    'folder' => 'entrepreneurships/products',
                ]);
                $productImagesUrls[] = $upload->getSecurePath();
            }
        }

        // Guardar datos en la base de datos
        $entrepreneurship = publish_Entrepreneurships::create([
            'name' => $validated['name'],
            'slogan' => $validated['slogan'],
            'category' => $validated['category'],
            'general_description' => $validated['general_description'],
            'logo_path' => $logoUrl,
            'background' => $backgroundUrl,
            'name_products' => $validated['name_products'], // Mantén como string
            'product_images' => $productImagesUrls, // Pasará por el mutador en el modelo
            'product_descriptions' => $validated['product_descriptions'], // Mantén como string
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
}
