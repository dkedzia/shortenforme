<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
        $todayDate = Carbon::now()->setTime(0, 0)->toDateString();
        return [
            'origin_url' => 'required|max:1000|url',
            'alias_should_expire' => 'in:1',
            'expires_on' => "exclude_unless:alias_should_expire,1|date|after:{$todayDate}",
        ];
    }
}
