<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use Illuminate\Foundation\Http\FormRequest;

class StoreTaskRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
     */
    public function rules(): array
    {
        return [
            'name'           => [
                'required',
                'max:100',
            ],
            'description'    => [],
            'status_id'      => [
                'required',
            ],
            'assigned_to_id' => [],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => trans('validation.task.required'),
            'status_id.required' => trans('validation.task.required'),
        ];
    }
}
