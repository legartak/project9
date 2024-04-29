<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;

class GoodsRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'goods_name' => ['required', 'string', 'max:255'],
            'goods_description' => ['required', 'string', 'max:500'],
            'category_id' => ['required', 'integer', 'min:1'],
            'goods_price' => ['required', 'decimal:1,2', 'min:0.25'],
        ];
    }
}
