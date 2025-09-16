<?php

namespace App\Http\Controllers;

use App\Http\Requests\todos\TodoRequest;
use App\Http\Resources\TodoResource;
use App\Models\Todo;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Gate;

class TodoController extends Controller
{
    public function index(Request $request): JsonResponse
    {
        return response()->json([
            'todos' => TodoResource::collection($request->user()->todos)
        ]);
    }

    public function show(Todo $todo): JsonResponse
    {
        Gate::authorize('view', $todo);
        return response()->json([
            'todo' => TodoResource::make($todo)
        ]);
    }

    public function store(TodoRequest $request): JsonResponse
    {
        Gate::authorize('create', Todo::class);
        try {
            $todo = $request->user()->todos()->create([
                'category_id' => $request->validated('categoryId'),
                'todo_title' => $request->validated('todoTitle'),
                'todo_description' => $request->validated('todoDescription'),
                'todo_importance' => $request->validated('todoImportance'),
                'todo_due_date' => $request->validated('todoDueDate')
            ]);
            return response()->json([
                'todo' => TodoResource::make($todo->refresh())
            ], 201);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error at creating todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function update(TodoRequest $request, Todo $todo): JsonResponse
    {
        Gate::authorize('update', $todo);
        try {
            $todo->update([
                'category_id' => $request->validated('categoryId'),
                'todo_title' => $request->validated('todoTitle'),
                'todo_description' => $request->validated('todoDescription'),
                'todo_importance' => $request->validated('todoImportance'),
                'todo_due_date' => $request->validated('todoDueDate')
            ]);
            return response()->json([
                'todo' => TodoResource::make($todo)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error at updating todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function delete(Todo $todo): JsonResponse|Response
    {
        Gate::authorize('delete', $todo);
        try {
            $todo->delete();
            return response(status: 204);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error at deleting todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }

    public function toggleStatus(Todo $todo): JsonResponse
    {
        Gate::authorize('update', $todo);
        try {
            $todo->update([
                'todo_completed' => !$todo->todo_completed
            ]);
            return response()->json([
                'todo' => TodoResource::make($todo)
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'message' => 'Error at updating todo',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
