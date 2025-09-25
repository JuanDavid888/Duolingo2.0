<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreProgressRequest;
use App\Http\Requests\UpdateAnswerRequest;
use App\Http\Requests\UpdateProgressRequest;
use App\Http\Resources\ProgressResource;
use App\Traits\ApiResponse;
use App\Models\Progress;

class ProgressController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Progress::with(['users', 'lessons']);

        // Some filters
        if ($request->has('id_user')) {
            $query->where('id_user', $request->query('id_user'));
        }

        if ($request->has('id_lesson')) {
            $query->where('id_lesson', $request->query('id_lesson'));
        }

        if ($request->has('score')) {
            $query->where('score', $request->query('score'));
        }

        $progress = $query->get();

        if ($progress->isEmpty()) {
            return response()->json([
                'message' => 'There are no progress matching the provided filters.',
            ], 404);
        }

        return $this->success(ProgressResource::collection($progress));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreProgressRequest $request): JsonResponse
    {
        $data = $request->validated();

        $progress = Progress::create($data);

        return $this->success(new ProgressResource($progress), 'Progress created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $progress = Progress::find($id);

        if (!$progress) {
            return $this->error("Progress not found", 404, ['id' => 'The id provided doesn`t exist']);
        }

        return $this->success(new ProgressResource($progress), "Progress found successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateAnswerRequest $request, Progress $progress): JsonResponse
    {
        $data = $request->validated();

        $progress->update($data);

        return $this->success(new ProgressResource($progress), 'Progress updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Progress $progress)
    {
        $progress->delete();

        return $this->success(null, 'Progress deleted successfully');
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore(string $id)
    {
        $progress = Progress::withTrashed()->find($id);

        if (!$progress) {
            return $this->error("Progress not found", 404, ['id' => 'The id provided doesn`t exist']);
        }

        $progress->restore();

        return $this->success(new ProgressResource($progress), 'Progress restored successfully');
    }
}
