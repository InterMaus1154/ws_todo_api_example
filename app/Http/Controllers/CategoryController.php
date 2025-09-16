<?php

namespace App\Http\Controllers;

use App\Http\Requests\categories\CategoryRequest;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'categories' => CategoryResource::collection($request->user()->categories)
        ]);
    }

    public function show(Category $category): JsonResponse
    {
        Gate::authorize('view', $category);
        return response()->json([
            'category' => CategoryResource::make($category)
        ]);
    }

    public function store(CategoryRequest $request): JsonResponse
    {
        try {
            $category = $request->user()->categories()->create([
                'category_name' => $request->validated('categoryName')
            ]);
            return response()->json([
                'category' => CategoryResource::make($category)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error at creating category',
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        Gate::authorize('update', $category);
        try {
            $category->update([
                'category_name' => $request->validated('categoryName')
            ]);
            return response()->json([
                'category' => CategoryResource::make($category)
            ], 200);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error at updating category',
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }

    public function delete(Category $category): JsonResponse|Response
    {
        Gate::authorize('delete', $category);
        try {
            $category->delete();
            return response(status: 204);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error at deleting category',
                'error' => $e->getMessage()
            ], $e->getCode());
        }
    }
}
