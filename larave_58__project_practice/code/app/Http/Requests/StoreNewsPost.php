<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreNewsPost extends FormRequest
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
            'title' => 'required|max:16',
            'contents' => 'required',
            'views' => 'required|integer'
        ];
    }
    public function messages()
    {
        return [
            'title.required' => '标题不能为空',
            'title.max' => '标题长度最大为16',
            'contents.required' => '内容不能为空',
            'views.required' => '浏览次数不能为空',
            'views.integer' => '浏览次数必须是整数',
        ];
    }

    public function attributes()
    {
        return [
            'views' =>'浏览次数'
        ];
    }
}
