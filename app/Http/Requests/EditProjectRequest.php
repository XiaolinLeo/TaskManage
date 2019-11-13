<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
class EditProjectRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */



    //用户权限 一般不在这边设置 返回True即可
    public function authorize()
    {
        return True;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => [
                'required',
                // 对当前用户唯一性判断
                Rule::unique('projects')->ignore($this->route('project'))->where(function ($query) {
                    return $query->where('user_id', request()->user()->id);
                })
            ],
            'thumbnail' => 'image'
        ];
    }

    public function messages()
    {
        return [
//            'name.unique'=>'任务名重复',
        ];
    }


    protected function failedValidation(Validator $validator)
    {
        $this-> errorBag = 'update-'.$this->route('project');
        parent::failedValidation($validator);
    }
}
