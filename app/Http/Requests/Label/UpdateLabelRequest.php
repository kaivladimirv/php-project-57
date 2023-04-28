<?php

declare(strict_types=1);

namespace App\Http\Requests\Label;

use App\Models\Label;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLabelRequest extends FormRequest
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
        $labelId = $this->route('label')->id;

        return [
            'name'        => [
                'required',
                'max:50',
                Rule::unique(Label::class)->ignore($labelId),
            ],
            'description' => ['nullable'],
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => trans('validation.label.required'),
            'name.unique'   => trans('validation.label.unique'),
        ];
    }
}
