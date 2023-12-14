<?php

namespace App\Http\Requests\Antireflective;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAntireflectiveRequest extends FormRequest
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
    public function rules(CreateAntireflectiveRequest $create)
    {
        $updateRules = [];
        return array_merge($updateRules, $create->rules());
    }
}
