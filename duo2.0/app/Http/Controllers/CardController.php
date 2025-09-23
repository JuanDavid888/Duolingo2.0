<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreCardRequest;
use App\Http\Requests\UpdateCardRequest;
use App\Http\Resources\CardResource;
use App\Traits\ApiResponse;
use App\Models\Card;

class CardController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Card::with(['lesson', 'category']);

        if ($request->has('word')) {
            $query->where('word', 'like', '%' . $request->query('word') . '%');
        }

        if ($request->has('mime_type')) {
            $query->where('mime_type', 'like', '%' . $request->query('mime_type') . '%');
        }

        if ($request->has('code')) {
            $query->where('code', $request->query('code'));
        }

        $lessonId = $request->query('id_lesson');
        $categoryId = $request->query('id_category');
        $perPage = $request->query('per_page', 10); // Number of results per page, default 10

        if ($lessonId) {
            $query->where('id_lesson', $lessonId);
        }

        if ($categoryId) {
            $query->where('id_category', $categoryId);
        }

        $cards = $query->paginate($perPage);

        // Verificar si no hay resultados
        if ($cards->isEmpty()) {
            return response()->json([
                'message' => 'There are no items matching the provided filters.',
            ], 404);
        }
    
        return $this->success(CardResource::collection($cards));
    }

    public function store(StoreCardRequest $request)
    {
        // Validamos los datos y obtenemos el archivo
        $validated = $request->validated(); // Esto validará los datos usando StoreCardRequest

        // Subir el archivo
        if ($request->hasFile('file_path')) {
            $file = $request->file('file_path');
            
            // Generamos un nombre único para el archivo
            $fileName = uniqid('card_', true) . '.' . $file->getClientOriginalExtension();
            
            // Guardamos el archivo en el directorio adecuado (puedes cambiar 'public' por el disco que prefieras)
            $filePath = $file->storeAs('cards', $fileName, 'public'); // 'public' es un ejemplo de disco, puedes configurarlo en config/filesystems.php
        } else {
            return response()->json([
                'message' => 'File is required.'
            ], 400);
        }

        // Creamos un nuevo Card en la base de datos
        $card = Card::create([
            'id_lesson' => $validated['id_lesson'],
            'id_category' => $validated['id_category'],
            'word' => $validated['word'],
            'file_path' => $filePath, // El archivo guardado
            'mime_type' => $validated['mime_type'],
            'code' => $validated['code'],
        ]);

        // Respondemos con el recurso creado
        return $this->success(
            new CardResource($card),
            'Card created successfully.'
        );
    }



    /**
     * Display the specified resource.
     */
    public function show(Card $card)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Card $card)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCardRequest $request, Card $card)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Card $card)
    {
        //
    }
}
