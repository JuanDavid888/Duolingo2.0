<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use App\Models\CardUserFavorite;
use App\Traits\ApiResponse;

class UserFavoriteController extends Controller
{
    use ApiResponse;
    
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */

    //agregar una tarjeta  favoritos
    
    public function store(Request $request)
    {
        $data = $request->validated();

        // Verify if an 'id_user' exists with an 'id_card'
        $existingProgress = User::where('id_user', $data['id_user'])
            ->where('card_id', $data['card_id'])
            ->first();
            
        if ($existingProgress) {
            return $this->error('esta leccion ya la marco el usuario', 400, [
                'id_user' => 'The user already has progress for this card.',
                'id_card' => 'The card already has progress for this user.'
            ]);
        } 

        $request->validate([
            'user_id' => 'required|exists:users,id',
            'card_id' => 'required|exists:cards,id',
        ]);

        $favorite = CardUserFavorite::create([
            'user_id' => $request->user_id,
            'card_id' => $request->card_id,
        ]);
        

        return response()->json([
            'message' => 'Tarjeta agregada a favoritos exitosamente',
            'data' => $favorite
        ], 201);



        
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
