<?php

namespace App\Http\Controllers\api;

use App\Models\publish_Entrepreneurships;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class PublishEntrepreneurshipsController extends Controller
{
    public function index()
    {
        $publishEntrepreneurships = publish_Entrepreneurships::all();
        $publishEntrepreneurships = publish_Entrepreneurships::included()->get();
        $publishEntrepreneurships = publish_Entrepreneurships::included()->filter();
         $publishEntrepreneurships=publish_Entrepreneurships::included()->filter()->sort()->get();
         $publishEntrepreneurships=publish_Entrepreneurships::included()->filter()->sort()->getOrPaginate();

        $publishEntrepreneurships = publish_Entrepreneurships::included()->get();
        return response()->json($publishEntrepreneurships);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'description' => 'required',
            'category' => 'required',
            'specifications' => 'required',
            'logo' => 'required|image|max:2048',
            'cover' => 'required|image|max:2048',
            'product_image_1' => 'required|image|max:2048',
            'product_image_2' => 'required|image|max:2048',
            'product_image_3' => 'required|image|max:2048',
            'product_image_4' => 'required|image|max:2048',
            'product_description_1' => 'required',
            'product_description_2' => 'required',
            'product_description_3' => 'required',
            'product_description_4' => 'required',
            'general_description' => 'required',
            'phone_number' => 'required|max:255',
            'email' => 'required|email|max:255',
            'location' => 'required|max:255',
            'url' => 'required|max:255',
            'expiration_date' => 'required|date',
        ]);

        // Guardar imágenes
        $logoPath = $request->file('logo')->store('entrepreneurships/logos', 'public');
        $coverPath = $request->file('cover')->store('entrepreneurships/covers', 'public');
        
        $productImages = [];
        for ($i = 1; $i <= 4; $i++) {
            $productImages[$i] = $request->file("product_image_$i")
                ->store("entrepreneurships/products", 'public');
        }

        // Crear el emprendimiento con todos los campos
        $entrepreneurshipData = [
            'name' => $request->name,
            'phone_number' => $request->phone_number,
            'email' => $request->email,
            'description' => $request->description,
            'location' => $request->location,
            'url' => $request->url,
            'category' => $request->category,
            'expiration_date' => $request->expiration_date,
            'specifications' => $request->specifications,
            'general_description' => $request->general_description,
            'logo_path' => $logoPath,
            'cover_path' => $coverPath,
            'product_images' => json_encode($productImages),
            'product_descriptions' => json_encode([
                $request->product_description_1,
                $request->product_description_2,
                $request->product_description_3,
                $request->product_description_4,
            ]),
            'entrepreneurs_id' => auth()->id(), // Asumiendo que tienes autenticación
        ];

        $publishEntrepreneurship = publish_Entrepreneurships::create($entrepreneurshipData);
        return response()->json([
            'success' => true,
            'message' => 'Emprendimiento creado exitosamente',
            'data' => $publishEntrepreneurship
        ], 201);
    }

    public function show($id)
    {
        $publishEntrepreneurship = publish_Entrepreneurships::included()->findOrFail($id);
        return response()->json($publishEntrepreneurship);
    }

    public function update(Request $request, publish_Entrepreneurships $publishEntrepreneurship)
    {
        $request->validate([
            'name' => 'required|max:255',
            'phone_number' => 'required|max:255',
            'email' => 'required|email|max:255',
            'description' => 'required|max:255',
            'location' => 'required|max:255',
            'url' => 'required|max:255',
            'expiration_date' => 'required|date',
            'category' => 'required',
            'specifications' => 'required',
            'general_description' => 'required',
            'logo' => 'sometimes|image|max:2048',
            'cover' => 'sometimes|image|max:2048',
            'product_image_1' => 'sometimes|image|max:2048',
            'product_image_2' => 'sometimes|image|max:2048',
            'product_image_3' => 'sometimes|image|max:2048',
            'product_image_4' => 'sometimes|image|max:2048',
        ]);

        $entrepreneurshipData = $request->except([
            'logo', 'cover', 'product_image_1', 'product_image_2', 
            'product_image_3', 'product_image_4'
        ]);

        // Actualizar imágenes si se proporcionan nuevas
        if ($request->hasFile('logo')) {
            // Eliminar logo anterior
            Storage::disk('public')->delete($publishEntrepreneurship->logo_path);
            $entrepreneurshipData['logo_path'] = $request->file('logo')
                ->store('entrepreneurships/logos', 'public');
        }

        if ($request->hasFile('cover')) {
            Storage::disk('public')->delete($publishEntrepreneurship->cover_path);
            $entrepreneurshipData['cover_path'] = $request->file('cover')
                ->store('entrepreneurships/covers', 'public');
        }

        // Actualizar imágenes de productos si se proporcionan nuevas
        $currentProductImages = json_decode($publishEntrepreneurship->product_images, true);
        $newProductImages = $currentProductImages;

        for ($i = 1; $i <= 4; $i++) {
            if ($request->hasFile("product_image_$i")) {
                // Eliminar imagen anterior
                Storage::disk('public')->delete($currentProductImages[$i]);
                $newProductImages[$i] = $request->file("product_image_$i")
                    ->store("entrepreneurships/products", 'public');
            }
        }

        $entrepreneurshipData['product_images'] = json_encode($newProductImages);

        // Actualizar descripciones de productos si se proporcionan nuevas
        if ($request->has('product_description_1')) {
            $entrepreneurshipData['product_descriptions'] = json_encode([
                $request->product_description_1,
                $request->product_description_2,
                $request->product_description_3,
                $request->product_description_4,
            ]);
        }

        $publishEntrepreneurship->update($entrepreneurshipData);
        
        return response()->json([
            'success' => true,
            'message' => 'Emprendimiento actualizado exitosamente',
            'data' => $publishEntrepreneurship
        ]);
    }

    public function destroy(publish_Entrepreneurships $publishEntrepreneurship)
    {
        // Eliminar imágenes almacenadas
        Storage::disk('public')->delete([
            $publishEntrepreneurship->logo_path,
            $publishEntrepreneurship->cover_path
        ]);

        // Eliminar imágenes de productos
        $productImages = json_decode($publishEntrepreneurship->product_images, true);
        foreach ($productImages as $image) {
            Storage::disk('public')->delete($image);
        }

        $publishEntrepreneurship->delete();
        
        return response()->json([
            'success' => true,
            'message' => 'Emprendimiento eliminado exitosamente'
        ]);
    }
}