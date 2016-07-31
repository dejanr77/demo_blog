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
        $segment = request()->segment(2);

        $unique_title = is_null($segment) ? 'unique:articles': 'unique:articles,title,'.$segment;

        if(request()->method() === 'DELETE') return [];

        return [
            'title' => 'required|min:3|max:240|'.$unique_title,
            'excerpt' => 'required|min:3|max:128',
            'body' => 'required',
            'published_at' => 'required|date|date_format:Y-m-d'
        ];
    }
}
