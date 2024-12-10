<?php

namespace App\Http\Controllers\api;

use App\Models\Investor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;


class InvestorController extends Controller
{
    public function index()
    {
        $investors = Investor::included() // Incluye relaciones según el parámetro 'included'
                            ->filter()   // Aplica filtros según el parámetro 'filter'
                            ->sort()     // Ordena los resultados según el parámetro 'sort'
                            ->getOrPaginate(); // Pagina los resultados si se proporciona el parámetro 'perPage'
        return response()->json($investors);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birth_date' => 'required|date',
            'investment_number' => 'required',
            'password' => 'required|min:8',
            'document' => 'required',
            'phone' => 'required|max:20',
            'image' => 'nullable',
            'email' => 'required|email|unique:investors',
            'location' => 'required|max:255',
        ]);

        $investor = Investor::create($request->all());
        return response()->json($investor);
    }

    public function show($id)
    {
        $investor = Investor::included()->findOrFail($id);
        return response()->json($investor);
    }


        public function update(Request $request, $id = null)
        {
            try {
                // Determinar si es el usuario autenticado o uno específico
                $investor = $id ? Investor::findOrFail($id) : $request->investor();

                // Validar los datos enviados
                $validated = $request->validate([
            'name' => 'required|max:255',
            'lastname' => 'required|max:255',
            'birth_date' => 'required|date',
            'investment_number' => 'required',
            'document' => 'required',
            'phone' => 'required|max:20',
            'image' => 'nullable',
            'email' => 'required|email|unique:investors,email,' . $investor->id,
            'location' => 'required|max:255',
                ]);

                $imageUrl = $investor->pic_profile; // Mantener la imagen actual si no hay nueva

                if ($request->hasFile('pic_profile')) {
                    // Si hay imagen nueva, eliminar la anterior de Cloudinary
                    if ($investor->pic_profile) {
                        $publicId = pathinfo(parse_url($investor->pic_profile, PHP_URL_PATH), PATHINFO_FILENAME);
                        Cloudinary::destroy($publicId);
                    }

                    // Subir la nueva imagen
                    $image = $request->file('pic_profile');
                    $uploadedFile = Cloudinary::upload($image->getRealPath());
                    $imageUrl = $uploadedFile->getSecurePath();
                }

                // Actualizar los campos enviados
                $investor->update([
                    'name' => $validated['name'] ?? $investor->name,
                    'last_name' => $validated['last_name'] ?? $investor->last_name,
                    'birthdate' => $validated['birthdate'] ?? $investor->birthdate,
                    'investment_number' => $validated['investment_number'] ?? $investor->investment_number,
                    'document' => $validated['document'] ?? $investor->document,
                    'phone' => $validated['phone'] ?? $investor->phone,
                    'pic_profile' => $imageUrl,
                    'email' => $validated['email'] ?? $investor->email,
                    'location' => $validated['location'] ?? $investor->location,

                ]);

                return response()->json([
                    'message' => 'Investor updated successfully!',
                    'investor' => $investor->only(['id', 'name', 'last_name', 'birthdate', 'investment_number','document','phone','pic_profile','email', 'location', 'pic_profile']),
                ], 200);
            } catch (\Illuminate\Validation\ValidationException $e) {
                return response()->json([
                    'message' => 'Validation error.',
                    'errors' => $e->errors(),
                ], 422);
            } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
                return response()->json([
                    'message' => 'Investor not found.',
                    'error' => $e->getMessage(),
                ], 404);
            } catch (\Exception $e) {
                return response()->json([
                    'message' => 'Error updating the investor.',
                    'error' => $e->getMessage(),
                ], 500);
            }
        }


    public function destroy(Investor $investor)
    {
        $investor->delete();
        return response()->json($investor);
    }
}
