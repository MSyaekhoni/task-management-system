<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'title'       => 'required|string|max:255|not_regex:/^\s*$/',
            'category'    => 'required|string|max:100',
            'creator_id'  => 'required|integer',
            'description' => 'required|string|max:1000',
            'due_date'    => 'required|date|after_or_equal:today',
            'priority'    => 'required|in:Low,Medium,High',
            'status'      => 'required|in:Pending,In Progress,Completed',
        ];
    }
}
