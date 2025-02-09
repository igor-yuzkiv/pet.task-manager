<?php

namespace App\Domains\Project\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'name'        => ['required', 'string'],
            'description' => ['nullable', 'string'],
            'status'      => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
