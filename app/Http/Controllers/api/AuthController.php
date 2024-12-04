<?php

namespace App\Http\Controllers\api;


use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Entrepreneur; // Asegúrate de tener esta línea
use App\Models\Investor;     // Y esta
use Illuminate\Support\Facades\DB;
use Validator;

class AuthController extends Controller
{
    /**
     * Create a new AuthController instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth:api', ['except' => ['login', 'register']]);
    }


    /**
     * Register a User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function register()
    {
        $validator = Validator::make(request()->all(), [
            'name' => 'required',
            'lastname' => 'required',
            'birth_date' => 'required|date',
            'password' => 'required|confirmed|min:8',
            'phone' => 'required|string',
            'image' => 'required|string',
            'email' => 'required|email|unique:users',
            'location' => 'required|string',
            'number' => 'required|integer',
            'role' => 'required|in:entrepreneur,investor',

        ]);

        if($validator->fails()){
            return response()->json($validator->errors()->toJson(), 400);
        }

        try {
            DB::beginTransaction();

            // Creamos el usuario
            $user = new User;
            $user->name = request()->name;
            $user->lastname = request()->lastname;
            $user->birth_date = request()->birth_date;
            $user->password = bcrypt(request()->password);
            $user->phone = request()->phone;
            $user->image = request()->image;
            $user->email = request()->email;
            $user->location = request()->location;
            $user->number = request()->number;
            $user->save();

            // Dependiendo del rol, creamos el registro en la tabla correspondiente
            if (request()->role === 'entrepreneur') {
                $entrepreneur = new Entrepreneur;
                $entrepreneur->user_id = $user->id; // Establecer explícitamente el user_id
                $entrepreneur->save();
            } else {
                $investor = new Investor;
                $investor->user_id = $user->id; // Establecer explícitamente el user_id
                // Campos específicos para inversionistas si los hay
                $investor->save();
            }

            DB::commit();

            return response()->json($user, 201);

        } catch (\Exception $e) {
            DB::rollBack();
            return response()->json([
                'error' => 'Error en el registro',
                'message' => $e->getMessage()
            ], 500);
        }
    }


    /**
     * Get a JWT via given credentials.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function login()
    {
        $credentials = request(['email', 'password', 'role']);

        // Validar que el rol sea válido
        if (!in_array($credentials['role'], ['entrepreneur', 'investor'])) {
            return response()->json(['error' => 'Rol inválido'], 400);
        }

        // Verificar credenciales y rol
        if (!$token = auth()->attempt([
            'email' => $credentials['email'],
            'password' => $credentials['password']
        ])) {
            return response()->json(['error' => 'Unauthorized'], 401);
        }

        // Verificar que el usuario tenga el rol correcto
        $user = auth()->user();
        if ($credentials['role'] === 'entrepreneur' && !$user->entrepreneur) {
            return response()->json(['error' => 'No tienes permisos de emprendedor'], 403);
        }

        if ($credentials['role'] === 'investor' && !$user->investor) {
            return response()->json(['error' => 'No tienes permisos de inversionista'], 403);
        }

        return $this->respondWithToken($token);
    }


    /**
     * Get the authenticated User.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function me()
    {
        return response()->json(auth()->user());
    }

    /**
     * Log the user out (Invalidate the token).
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout()
    {
        auth()->logout();

        return response()->json(['message' => 'Successfully logged out']);
    }

    /**
     * Refresh a token.
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function refresh()
    {
        return $this->respondWithToken(auth()->refresh());
    }


    /**
     * Get the token array structure.
     *
     * @param  string $token
     *
     * @return \Illuminate\Http\JsonResponse
     */


    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
        ]);
    }
}

