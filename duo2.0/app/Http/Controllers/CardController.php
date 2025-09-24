<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
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
        // Connection with other tables
        $query = Card::with(['lesson', 'category']);


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

        $lessonId = $request->query('id_lesson');
        $categoryId = $request->query('id_category');

        if ($lessonId) {
            $query->where('id_lesson', $lessonId);
        }

        if ($categoryId) {
            $query->where('id_category', $categoryId);
        }

        $cards = $query->get();

        // Validate that cards isn't empty
        if ($cards->isEmpty()) {
            return response()->json([
                'message' => 'There are no items matching the provided filters.',
            ], 404);
        }

        return $this->success(CardResource::collection($cards));
    }


    public function store(StoreCardRequest $request): JsonResponse
    {
        $data = $request->validated();

        if ($request->hasFile('file_path')) {
            $data['file_path'] = $request->file('file_path')->store('posts', 'public');
        }

        $newCard = Card::create($data);

        $newCard->load(['lesson', 'category']);

        return $this->success(new CardResource($newCard), 'Card created successfully', 201);
    }



    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $card = Card::with(['lesson', 'category'])->find($id);

        if (!$card) {
            return $this->error("Card not found", 404, ['id' => 'The id provided doesn`t exists']);
        }

        return $this->success(new CardResource($card), "Card found successfully");
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
        $card->delete();
        return $this->success(null, 'Card eliminated successfully');
    }

    public function restore(string $id)
    {
        // Include deleted records (withTrashed) to search for them
        $card = Card::withTrashed()->find($id);
    
        if (!$card) {
            return $this->error("Card not found", 404, ['id' => 'The id provided doesn`t exists']);
        }
    
        $card->restore();
        return $this->success(new CardResource($card),'Card correctly restored.');
    }
}
