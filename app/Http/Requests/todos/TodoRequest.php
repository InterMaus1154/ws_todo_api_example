<?php

namespace App\Http\Requests\todos;

use App\Enums\TodoImportance;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class TodoRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return auth()->check();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'categoryId' => ['required',
                Rule::exists('categories', 'id')->where(function ($query) {
                    $query->where('user_id', auth()->id());
                })],
            'todoTitle' => 'required|string|max:150',
            'todoDescription' => 'nullable|string',
            'todoImportance' => ['required', Rule::in(array_map(fn(TodoImportance $importance) => $importance->value, TodoImportance::cases()))],
            'todoDueDate' => 'required|date'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'errors' => $validator->errors()->all()
        ], 422));
    }
}
