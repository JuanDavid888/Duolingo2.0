<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreAnswerRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Resources\AnswerResource;
use App\Traits\ApiResponse;
use App\Models\Answer;
use App\Models\Card;

class AnswerController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Answer::with('card');

        // Some filters
        if ($request->has('card_code')) {
            $query->where('card_code', $request->query('card_code'));
        }

        if ($request->has('id_card')) {
            $query->where('id_card', $request->query('id_card'));
        }

        $answers = $query->get();

        if ($answers->isEmpty()) {
            return response()->json([
                'message' => 'There are no answers matching the provided filters.',
            ], 404);
        }

        return $this->success(AnswerResource::collection($answers));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreAnswerRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Search Cards by 'code'
        $card = Card::where('code', $data['card_code'])->first();

        if (!$card) {
            return $this->error('Card not found', 404);
        }

        // Verify if that answer already exists
        $existingAnswer = Answer::where('card_code', $card->code)->first();

        if ($existingAnswer) {
            return $this->error('An answer with this card code already exists.', 409, [
                'card_code' => 'Already used'
            ]);
        }

        // Create the id_card acording to card_code from Card
        $answer = Answer::create([
            'id_card' => $card->id,
            'card_code' => $card->code,
        ]);

        return $this->success(new AnswerResource($answer), 'Answer created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $answer = Answer::find($id);

        if (!$answer) {
            return $this->error("Lesson not found", 404, ['id' => 'The id provided doesn`t exist']);
        }

        return $this->success(new AnswerResource($answer), "Answer found successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request, $id): JsonResponse
    {
        $answer = Answer::find($id);

        if (!$answer) {
            return $this->error("Answer not found", 404, ['id' => 'The answer id provided doesn`t exist']);
        }

        $data = $request->validated();

        // Update the id_card according to the card_code associated
        if (isset($data['card_code'])) {
            $card = Card::where('code', $data['card_code'])->first();

            if (!$card) {
                return $this->error('Card with this code does not exist.', 404, ['card_code' => 'The card code provided doesn’t exist']);
            }

            $data['id_card'] = $card->id;
        }

        $answer->update($data);

        return $this->success(new AnswerResource($answer), 'Answer updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Answer $answer)
    {
        $answer->delete();

        return $this->success(null, 'Answer deleted successfully');
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore(string $id)
    {
        $answer = Answer::withTrashed()->find($id);

        if (!$answer) {
            return $this->error("Answer not found", 404, ['id' => 'The id provided doesn`t exist']);
        }

        $answer->restore();

        return $this->success(new AnswerResource($answer), 'Answer restored successfully');
    }
}
