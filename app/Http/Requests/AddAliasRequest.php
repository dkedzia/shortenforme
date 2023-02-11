<?php

namespace App\Http\Requests;

use App\Rules\CustomUrl;
use Illuminate\Foundation\Http\FormRequest;

class AddAliasRequest extends FormRequest
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
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
//            'origin_url' => 'required|max:1000|url',
            'origin_url' => ['required', 'max:1000', new CustomUrl],
        ];
    }


}
