<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ItemRequest extends FormRequest
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
        $rule = [
            'title' => 'required|string|max:50',
            'body' => 'required|string|max:2000',
            'price' => 'required|integer|min:1',
        ];

        $route = $this->route()->getName();
        if ($route === 'items.store') {
            $rule['file.*'] = 'required|file|image';
        }
        return $rule;
    }
}
