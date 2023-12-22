<?php

namespace App\Http\Requests\Package;

use Illuminate\Foundation\Http\FormRequest;

class PackageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => ['required'],
            'price' => ['required', 'numeric'],
            'description' => ['nullable'],
            'level' => ['required'],
            'color' => ['nullable', 'string', 'regex:/^#[A-Fa-f0-9]{6}$|^#[A-Fa-f0-9]{3}$/'],
            'antireflectives' => ['required_without_all:materials,frames', 'array'],
            'materials' => ['required_without_all:antireflectives,frames', 'array'],
            'frames' => ['required_without_all:antireflectives,materials', 'array'],
        ];
    }
}
