<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateTaskRequest extends FormRequest
{


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

            'name' => 'required',
            'project' => [
                'required',
                'integer',
                Rule::exists('projects', 'id')->where(function ($query) {
                    return $query->whereIn('id', $this->user()->projects()->pluck('id'));
                })//提交的id必须在projects存在 //两种方式这种方式是数据库的whereIn
            ]
        ];
    }

    public function messages()
    {
        return [
            'project.exists' => '干嘛呢想'
        ];
    }

    protected function failedValidation(Validator $validator)
    {
        $this-> errorBag = 'update-'.$this->route('task');
        parent::failedValidation($validator);
    }
}
