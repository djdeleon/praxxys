<?php

namespace App\Http\Requests\Products;

use Illuminate\Foundation\Http\FormRequest;

class ProductStoreRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'name' => 'required',
            'category_id' => 'required',
            'description' => 'required',
            'images' => 'required',
            'date_time' => 'required',
        ];
    }
}
