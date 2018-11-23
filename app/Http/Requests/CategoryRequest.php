<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CategoryRequest extends FormRequest
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
    {      //request.php里有route方法，这里是调用父类里面的方法
        //接受路由参数
        //dd($this->route('category'));
        $id=$this->route('category')? $this->route('category')->id:null;
        return [
        'title'=>'required|unique:categories,title,'.$id,
            'icon'=>'required'
        ];
    }

    public function messages(){

        return [
            'title.required'=>'请输入栏目名称',
            'title.unique'=>'栏目已存在',
            'icon.required'=>'请选择栏目图标',

        ];
    }
}
