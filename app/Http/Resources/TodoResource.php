<?php

namespace App\Http\Resources;

use App\Enums\TodoImportance;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class TodoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'categoryId' => $this->category_id,
            'categoryName' => $this->category->category_name,
            'todoId' => $this->id,
            'todoTitle' => $this->todo_title,
            'todoCompleted' => (bool)$this->todo_completed,
            'todoDescription' => $this->whenNotNull($this->todo_description),
            'todoImportance' => TodoImportance::from($this->todo_importance)->value,
            'todoDueDate' => Carbon::parse($this->todo_due_date)->toDateString(),
            'overdue' => $this->when(Carbon::parse($this->todo_due_date)->isBefore(Carbon::today()) && !$this->todo_completed, Carbon::parse($this->todo_due_date)->isBefore(Carbon::today()))
        ];
    }
}
