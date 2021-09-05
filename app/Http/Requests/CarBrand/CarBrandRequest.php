<?php

namespace App\Http\Requests\CarBrand;

use Illuminate\Foundation\Http\FormRequest;

class CarBrandRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:20',
            'description' => 'required|string'
        ];
    }
}
