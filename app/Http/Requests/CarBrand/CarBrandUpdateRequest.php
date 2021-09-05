<?php

namespace App\Http\Requests\CarBrand;

use Illuminate\Foundation\Http\FormRequest;

class CarBrandUpdateRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|string'
        ];
    }
}
