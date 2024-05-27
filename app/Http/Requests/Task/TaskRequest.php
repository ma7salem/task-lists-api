<?php

namespace App\Http\Requests\Task;

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
            'name'      => 'required',
            'details'   => 'nullable',
            'start_at'  => 'nullable|date_format:Y-m-d H:i:s|after:today',
            'label_id'  => 'nullable|exists:labels,id',
            'status'    => 'nullable|in:pending,started,completed,cancelled'
        ];
    }
}
