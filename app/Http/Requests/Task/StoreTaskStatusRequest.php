<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use Override;
use App\Models\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;

class StoreTaskStatusRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => [
                'required',
                'max:50',
                'unique:' . TaskStatus::class,
            ],
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'name.required' => trans('validation.task_status.required'),
            'name.unique'   => trans('validation.task_status.unique'),
        ];
    }
}
