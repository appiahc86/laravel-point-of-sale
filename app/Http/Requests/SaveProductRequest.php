<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SaveProductRequest extends FormRequest
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
            'category' => ['max:255'],
            'brand' => ['max:255'],
            'product_name' => ['required', 'string', 'max:255'],
            'cost_price' => ['required', 'numeric'],
            'wholesale_price' => ['required', 'numeric'],
            'retail_price' => ['required', 'numeric'],
            'profit' => ['required', 'numeric'],
            'quantity' => ['required', 'numeric']
        ];
    }
}
