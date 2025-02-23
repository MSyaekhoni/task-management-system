<?php

namespace App\Http\Requests;

use Illuminate\Support\Carbon;
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

    public function prepareForValidation()
    {
        // Konversi `due_date` ke format yang benar
        if ($this->has('due_date')) {
            $this->merge([
                'due_date' => Carbon::parse($this->due_date)->format('Y-m-d H:i:s')
            ]);
        }
    }


    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        $rules = [
            'title'       => 'required|string|max:255|not_regex:/^\s*$/',
            'category_id'    => 'required|string|max:100',
            'description' => 'required|string|max:1000',
            'priority_id'    => 'required|exists:priority_tasks,id',
            'status_id'      => 'required|exists:status_tasks,id',
        ];

        // jika method post maka validasi due_date dijalankan, jika put/patch tidak usah dijalankan
        if ($this->isMethod('post')) {
            $rules['due_date']    = 'required|date|after_or_equal:today';
        } else {
            $rules['due_date']    = 'required|date';
        }

        return $rules;
    }
}
