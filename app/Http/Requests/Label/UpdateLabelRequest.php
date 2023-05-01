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
        /** @var Label $label */
        $label = $this->route('label');

        return [
            'name'        => [
                'required',
                'max:50',
                Rule::unique(Label::class)->ignore($label->id),
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
