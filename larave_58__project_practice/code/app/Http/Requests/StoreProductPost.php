<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use App\Rules\CheckCidChilds;
class StoreProductPost extends FormRequest
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
            'cid'=>['required','integer',new CheckCidChilds],
            'title'=>'required',
            'remark'=>'required',
            'file'=>'required',
            'file'=>"image",
            'contents'=>'required',
        ];
    }

    public function messages()
    {
       return [
           'cid.required' =>"请先添加分类",
       ];
    }
}
