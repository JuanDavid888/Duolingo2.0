<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Http\Resources\UserResource;
use App\Models\User;
use App\Traits\ApiResponse;

class UserController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = User::query();

        // Some filters
        if ($request->has('word')) {
            $query->where('word', 'like', '%' . $request->query('word') . '%');
        }

        if ($request->has('mime_type')) {
            $query->where('mime_type', 'like', '%' . $request->query('mime_type') . '%');
        }

        if ($request->has('code')) {
            $query->where('code', $request->query('code'));
        }

        $cards = $query->get();

        // Validate that cards isn't empty
        if ($cards->isEmpty()) {
            return response()->json([
                'message' => 'There are no items matching the provided filters.',
            ], 404);
        }

        return $this->success(UserResource::collection($cards));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreUserRequest $request): JsonResponse
    {
        $data = $request->validated();

        $data['email_verified_at'] = now();
        $data['remember_token'] = Str::random(10);

        // Crear el nuevo usuario con los datos validados
        $newUser = User::create($data);

        // Retornar la respuesta con el recurso UserResource
        return $this->success(new UserResource($newUser), 'User created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(User $user)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateUserRequest $request, User $user)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(User $user)
    {
        //
    }
}
