<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Models\Task;
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
                'unique:' . Task::class,
            ],
            'description'    => ['nullable'],
            'status_id'      => [
                'required',
            ],
            'assigned_to_id' => ['nullable'],
            'labels'         => [
                'array',
                'nullable',
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required'      => trans('validation.task.required'),
            'name.unique'        => trans('validation.task.unique'),
            'status_id.required' => trans('validation.task.required'),
        ];
    }
}
