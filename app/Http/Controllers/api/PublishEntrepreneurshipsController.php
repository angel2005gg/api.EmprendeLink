<?php
namespace App\Http\Controllers\api;

use App\Models\publish_Entrepreneurships;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Myentrepreneurship;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class PublishEntrepreneurshipsController extends Controller
{
    public function index()
    {
        try {
            $entrepreneurships = publish_Entrepreneurships::all();

            return response()->json([
                'message' => 'Emprendimientos recuperados exitosamente',
                'data' => $entrepreneurships
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
        $user = $request->user(); 
        $user = Auth::user();// Obtener el usuario autenticado
        
        // Validaciones
        $validated = $request->validate([
            'name' => 'required|string',
            'slogan' => 'required|string',
            'category' => 'required|string',
            'general_description' => 'required|string',
            'logo_path' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'background' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'name_products' => 'required|array',
            'product_images.*' => 'required|image|mimes:jpeg,png,jpg|max:2048',
            'product_descriptions' => 'required|array',
            // 'entrepreneurs_id' => 'required|required|integer|exists:users,id'
        ]);

        try {

            // dd($validated);

            
            if (!Auth::check()) {
                return response()->json([
                    'message' => 'Usuario no autenticado'
                ], 401);
            }
        
            $userId = Auth::id();

        
            $user = Auth::user();
            Log::info('Usuario autenticado:', [
                'id' => $user ? $user->id : 'No autenticado',
                'name' => $user ? $user->name : 'N/A'
            ]);
    
            // Obtener ID de usuario
            $userId = Auth::id();
            Log::info('User ID:', [
                'userId' => $userId
            ]);
    
            // Resto de tu código...
        } catch (\Exception $e) {
            Log::error('Error en publicación de emprendimiento', [
                'message' => $e->getMessage(),
                'trace' => $e->getTraceAsString()
            ]);
        }
            
       

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
                'name_products' => $validated['name_products'],
                'product_images' => $productImagesUrls,
                'product_descriptions' => $validated['product_descriptions'],
                'entrepreneurs_id' => $userId, // Asigna automáticamente el ID del usuario
            ]);

                 // Crear la entrada en Myentrepreneurships
        Myentrepreneurship::create([
            'entrepreneurs_id' => $userId,
            'publish_Entrepreneurships_id' => $entrepreneurship->id,
        ]);

            return response()->json([
                'message' => 'Emprendimiento creado exitosamente!',
                'data' => $entrepreneurship,
            ], 201);
        // } catch (\Exception $e) {
        //     return response()->json([
        //         'message' => 'Error al crear el emprendimiento.',
        //         'error' => $e->getMessage(),
        //     ], 500);
        // }
    }

    public function show($id)
    {
        try {
            $entrepreneurship = publish_Entrepreneurships::findOrFail($id);

            return response()->json([
                'message' => 'Emprendimiento recuperado exitosamente',
                'data' => $entrepreneurship
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al recuperar el emprendimiento',
                'error' => $e->getMessage()
            ], 404);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            $entrepreneurship = publish_Entrepreneurships::findOrFail($id);

            $validated = $request->validate([
                'name' => 'sometimes|required|string',
                'slogan' => 'sometimes|required|string',
                'category' => 'sometimes|required|string',
                'general_description' => 'sometimes|required|string',
                'logo_path' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',
                'background' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',
                'name_products' => 'sometimes|required|array',
                'product_images.*' => 'sometimes|required|image|mimes:jpeg,png,jpg|max:2048',
                'product_descriptions' => 'sometimes|required|array',
                // 'entrepreneurs_id' => 'sometimes|required|integer|exists:users,id'
            ]);

            // Actualizar campos
            $entrepreneurship->fill($validated);

            // Manejar actualización de imágenes si se proporcionan
            if ($request->hasFile('logo_path')) {
                $logoUrl = Cloudinary::upload($request->file('logo_path')->getRealPath(), [
                    'folder' => 'entrepreneurships/logos',
                ])->getSecurePath();
                $entrepreneurship->logo_path = $logoUrl;
            }

            if ($request->hasFile('background')) {
                $backgroundUrl = Cloudinary::upload($request->file('background')->getRealPath(), [
                    'folder' => 'entrepreneurships/backgrounds',
                ])->getSecurePath();
                $entrepreneurship->background = $backgroundUrl;
            }

            // Manejar imágenes de productos
            if ($request->hasFile('product_images')) {
                $productImagesUrls = [];
                foreach ($request->file('product_images') as $productImage) {
                    $upload = Cloudinary::upload($productImage->getRealPath(), [
                        'folder' => 'entrepreneurships/products',
                    ]);
                    $productImagesUrls[] = $upload->getSecurePath();
                }
                $entrepreneurship->product_images = $productImagesUrls;
            }

            $entrepreneurship->save();

            return response()->json([
                'message' => 'Emprendimiento actualizado exitosamente',
                'data' => $entrepreneurship
            ], 200);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error al actualizar el emprendimiento',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $entrepreneurship = publish_Entrepreneurships::findOrFail($id);
            $entrepreneurship->delete();

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