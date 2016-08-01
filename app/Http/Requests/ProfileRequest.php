<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ProfileRequest extends Request
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
            'first_name' => 'required|min:3|max:12|alpha',
            'last_name' => 'required|min:3|max:16|alpha',
            'title' => 'max:9|alpha',
            'description' => 'required|max:255|regex:/^[A-Za-z0-9\-!\s,\'\"\/@\.:\(\)]+$/'
        ];
    }
}
