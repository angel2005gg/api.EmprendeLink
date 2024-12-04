<?php

namespace App\Http\Controllers\api;

namespace App\Models;

use App\Models\User;
use CloudinaryLabs\CloudinaryLaravel\Facades\Cloudinary;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Routing\Controller;

// use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all()->makeHidden(['password', 'remember_token']);
        return response()->json($users, 200);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'lastname' => 'required|string|max:255', // Corregido de "lasname"
            'birth_date' => 'required|date',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|integer|max:255',
            'image' => 'required|string',
            'email' => 'required|string|email|max:255|unique:users',
            'location' => 'required|string|max:255',
            'number' => 'required|integer|max:255',
        ]);

        try {
            $imageUrl = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $uploadedFile = Cloudinary::upload($image->getRealPath());
                $imageUrl = $uploadedFile->getSecurePath();
            }

            $user = User::create([
                'name' => $validated['name'],
                'lastname' => $validated['lastname'],
                'birth_date' => $validated['birth_date'],
                'password' => bcrypt($validated['password']),
                'phone' => $validated['phone'],
                'image' => $imageUrl,
                'email' => $validated['email'],
                'location' => $validated['location'],
                'number' => $validated['number'],
            ]);

            return response()->json([
                'message' => 'User created successfully!',
                'user' => $user,
            ], 201);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error creating the user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    

    public function show($id)
    {
        try {
            $user = User::findOrFail($id)->makeHidden(['password', 'remember_token']);
            return response()->json([
                'message' => 'User retrieved successfully!',
                'user' => $user,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.',
                'error' => $e->getMessage(),
            ], 404);
        }
    }

    public function update(Request $request, $id = null)
    {
        try {
            $user = $id ? User::findOrFail($id) : $request->user();

            $validated = $request->validate([
                'name' => 'required|string|max:255',
                'lastname' => 'required|string|max:255', // Corregido de "lasname"
                'birth_date' => 'required|date',
                'password' => 'required|confirmed|min:8',
                'phone' => 'required|integer|max:255',
                'image' => 'required|string',
                'email' => 'required|string|email|max:255|unique:users',
                'location' => 'required|string|max:255',
                'number' => 'required|integer|max:255',
            ]);

            $imageUrl = $user->image; // Mantener imagen actual

            if ($request->hasFile('image')) {
                if ($user->image) {
                    $publicId = pathinfo(parse_url($user->image, PHP_URL_PATH), PATHINFO_FILENAME);
                    Cloudinary::destroy($publicId);
                }

                $image = $request->file('image');
                $uploadedFile = Cloudinary::upload($image->getRealPath());
                $imageUrl = $uploadedFile->getSecurePath();
            }

            $user->update([
                'name' => $validated['name'] ?? $user->name,
                'lastname' => $validated['lastname'] ?? $user->lastname,
                'birth_date' => $validated['birth_date'] ?? $user->birth_date,
                'password' => $validated['password'] ?? $user->password,
                'phone' => $validated['phone'] ?? $user->phone,
                'image' => $imageUrl,
                'email' => $validated['email'] ?? $user->email,
                'location' => $validated['location'] ?? $user->location,
                'number' => $validated['number'] ?? $user->number,
            ]);

            return response()->json([
                'message' => 'User updated successfully!',
                'user' => $user,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error updating the user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function destroy($id)
    {
        try {
            $user = User::findOrFail($id);

            if ($user->image) {
                $publicId = pathinfo(parse_url($user->image, PHP_URL_PATH), PATHINFO_FILENAME);
                Cloudinary::destroy($publicId);
            }

            $user->delete();

            return response()->json([
                'message' => 'User deleted successfully!',
                'user' => $user,
            ], 200);
        } catch (\Illuminate\Database\Eloquent\ModelNotFoundException $e) {
            return response()->json([
                'message' => 'User not found.',
                'error' => $e->getMessage(),
            ], 404);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'Error deleting the user.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

    public function profile(Request $request)
    {
        $user = $request->user()->makeHidden(['password', 'remember_token']);
        return response()->json($user);
    }
}
