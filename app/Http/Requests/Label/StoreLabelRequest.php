<?php

declare(strict_types=1);

namespace App\Http\Requests\Label;

use Override;
use App\Models\Label;
use Illuminate\Foundation\Http\FormRequest;

class StoreLabelRequest extends FormRequest
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
            'name'        => [
                'required',
                'max:50',
                'unique:' . Label::class,
            ],
            'description' => ['nullable'],
        ];
    }

    #[Override]
    public function messages(): array
    {
        return [
            'name.required' => trans('validation.label.required'),
            'name.unique'   => trans('validation.label.unique'),
        ];
    }
}
