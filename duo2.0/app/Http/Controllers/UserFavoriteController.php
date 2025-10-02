<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Card;
use App\Models\Card_User_Favorite;

class UserFavoriteController extends Controller
{
    
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
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'card_id' => 'required|exists:cards,id',
        ]);

        $favorite = Card_User_Favorite::create([
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
