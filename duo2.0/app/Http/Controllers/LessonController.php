<?php

namespace App\Http\Controllers;

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreLessonRequest;
use App\Http\Requests\UpdateLessonRequest;
use App\Http\Resources\LessonResource;
use App\Traits\ApiResponse;
use App\Models\Lesson;

class LessonController extends Controller
{
    use ApiResponse;

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Lesson::query();

        // Some filters
        if ($request->has('title')) {
            $title = $request->query('title');
            $query->where(function ($q) use ($title) {
                $locales = ['es', 'en'];
                foreach ($locales as $locale) {
                    $q->orWhere("title->{$locale}", 'like', "%{$title}%");
                }
            });
        }

        if ($request->has('description')) {
            $description = $request->query('description');
            $query->where(function ($q) use ($description) {
                $locales = ['es', 'en'];
                foreach ($locales as $locale) {
                    $q->orWhere("description->{$locale}", 'like', "%{$description}%");
                }
            });
        }

        if ($request->has('level')) {
            $level = $request->query('level');
            $query->where(function ($q) use ($level) {
                $locales = ['es', 'en'];
                foreach ($locales as $locale) {
                    $q->orWhere("level->{$locale}", 'like', "%{$level}%");
                }
            });
        }

        if ($request->has('id_category')) {
            $query->where('id_category', $request->query('id_category'));
        }

        $lessons = $query->get();

        if ($lessons->isEmpty()) {
            return response()->json([
                'message' => 'There are no lessons matching the provided filters.',
            ], 404);
        }

        return $this->success(LessonResource::collection($lessons));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLessonRequest $request): JsonResponse
    {
        $data = $request->validated();

        $lesson = Lesson::create($data);

        return $this->success(new LessonResource($lesson), 'Lesson created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $lesson = Lesson::find($id);

        if (!$lesson) {
            return $this->error("Lesson not found", 404, ['id' => 'The id provided doesn`t exist']);
        }

        return $this->success(new LessonResource($lesson), "Lesson found successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLessonRequest $request, Lesson $lesson): JsonResponse
    {
        $data = $request->validated();

        $lesson->update($data);

        return $this->success(new LessonResource($lesson), 'Lesson updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Lesson $lesson)
    {
        $lesson->delete();

        return $this->success(null, 'Lesson deleted successfully');
    }

    /**
     * Restore the specified soft-deleted resource.
     */
    public function restore(string $id)
    {
        $lesson = Lesson::withTrashed()->find($id);

        if (!$lesson) {
            return $this->error("Lesson not found", 404, ['id' => 'The id provided doesn`t exist']);
        }

        $lesson->restore();

        return $this->success(new LessonResource($lesson), 'Lesson restored successfully');
    }
}
