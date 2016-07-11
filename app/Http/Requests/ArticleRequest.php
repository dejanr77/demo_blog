<?php

namespace App\Http\Requests;


class ArticleRequest extends Request
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
            'title' => 'required|min:3',
            'excerpt' => 'required|min:3|max:128',
            'body' => 'required',
            'published_at' => 'required|date|date_format:Y-m-d'
        ];
    }
}
