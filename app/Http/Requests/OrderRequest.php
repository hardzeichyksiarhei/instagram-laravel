<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest
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
          'cheat_name' => 'required',
          'cheat_id' => 'required|numeric',
          'count' => 'required|numeric',
          'link' => 'required|string',
          'price' => 'required|numeric',
        ];
    }
}
