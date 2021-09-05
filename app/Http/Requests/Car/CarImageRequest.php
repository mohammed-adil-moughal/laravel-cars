<?php

namespace App\Http\Requests\Car;

use Illuminate\Foundation\Http\FormRequest;

class CarImageRequest extends FormRequest
{

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'description' => 'required|string',
            'car' => 'required|integer',
            'file' => 'file|required|mimes:doc,docx,pdf,txt,png,jpeg',
        ];
    }
}
