<?php

namespace App\Domains\Project\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProjectRequest extends FormRequest
{
    public function rules(): array
    {
        $keyRules = ['nullable', 'string', 'min:3', 'max:10'];

        if ($this->method() === 'POST') {
            $keyRules[] = 'unique:projects,key';
        } else {
            $keyRules[] = 'unique:projects,key,'.$this->route('project')->id;
        }

        return [
            'name'        => ['required', 'string'],
            'key'         => $keyRules,
            'description' => ['nullable', 'string'],
            'status'      => ['nullable', 'string'],
        ];
    }

    public function authorize(): bool
    {
        return true;
    }
}
