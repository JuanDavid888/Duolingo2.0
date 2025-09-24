<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use App\Http\Requests\StoreCategoryRequest;
use App\Http\Requests\UpdateCategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Traits\ApiResponse;
use App\Models\Category;

class CategoryController extends Controller
{
    use ApiResponse;
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = Category::query();

        if ($request->has('name')) {
            $name = $request->query('name');
            $query->where(function ($q) use ($name) {
                $locales = ['sp', 'en'];
                foreach ($locales as $locale) {
                    $q->orWhere("name->{$locale}", 'like', "%{$name}%");
                }
            });
        }
    
        if ($request->has('description')) {
            $description = $request->query('description');
            $query->where(function ($q) use ($description) {
                $locales = ['sp', 'en'];
                foreach ($locales as $locale) {
                    $q->orWhere("description->{$locale}", 'like', "%{$description}%");
                }
            });
        }

        $categories = $query->get();

        if ($categories->isEmpty()) {
            return response()->json([
                'message' => 'There are no categories matching the provided filters.',
            ], 404);
        }

        return $this->success(CategoryResource::collection($categories));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreCategoryRequest $request): JsonResponse
    {
        $data = $request->validated();

        $category = Category::create($data);

        return $this->success(new CategoryResource($category), 'Category created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $category = Category::find($id);

        if (!$category) {
            return $this->error("Category not found", 404, ['id' => 'The id provided doesn`t exists']);
        }

        return $this->success(new CategoryResource($category), "Category found successfully");
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateCategoryRequest $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();

        return $this->success(null, 'Category deleted successfully');
    }

    public function restore(string $id)
    {
        // Include deleted records (withTrashed) to search for them
        $category = Category::withTrashed()->find($id);
    
        if (!$category) {
            return $this->error("Category not found", 404, ['id' => 'The id provided doesn`t exists']);
        }
    
        $category->restore();
        return $this->success(new CategoryResource($category),'Category correctly restored.');
    }
}
