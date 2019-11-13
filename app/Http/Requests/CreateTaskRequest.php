<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CreateTaskRequest extends FormRequest
{
    protected $errorBag = 'create';
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

            'name' => 'required',
            'project' => [
                'required',
                'integer',
                Rule::exists('projects', 'id')->whereIn('id',$this->user()->projects()->pluck('id')->toArray())
                //exists提交的id必须在projects存在  whereIn是Rule提供的 不会将结果转换为数组手动转换
            ]
        ];
    }
    public function messages()
    {
        return [
            'name.required' => '项目名不能为空'
        ];
    }
}
