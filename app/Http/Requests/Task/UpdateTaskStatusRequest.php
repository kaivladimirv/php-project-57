<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Models\TaskStatus;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskStatusRequest extends FormRequest
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
        /** @var TaskStatus $taskStatus */
        $taskStatus = $this->route('task_status');

        return [
            'name' => [
                'required',
                'max:50',
                Rule::unique(TaskStatus::class)->ignore($taskStatus->id),
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('validation.task_status.required'),
            'name.unique'   => trans('validation.task_status.unique'),
        ];
    }
}
