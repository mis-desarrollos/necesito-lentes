<?php

namespace App\Http\Requests\Optician;

use Illuminate\Foundation\Http\FormRequest;

class OpticianRequest extends FormRequest
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
            'email' => ['required', 'email'],
            'phone' => ['nullable'],
            'web' => ['nullable'],
            'address' => ['required'],
            'lng' => ['required'],
            'lat' => ['required'],
            'instagram' => ['nullable'],
            'facebook' => ['nullable'],
            'twitter' => ['nullable'],
        ];
    }
}
