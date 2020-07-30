<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ToDoRequest extends FormRequest
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
            'taskName'=>'required|max:30',
            'taskCategory'=>'required',
            //'taskImage'=>'required',
            'taskDesc'=>'required',
        ];
    }
    public function messages()
    {
        return [
            'taskName.required' =>__('messages.requiredName'),
            'taskName.max' =>__('messages.maxName'),
            // 'taskName.unique' =>__('messages.uniqueName'),
            'taskCategory.required' =>__('messages.requiredCategory'),
            //'taskImage.required' =>__('messages.requiredImage'),
            'taskDesc.required' =>__('messages.requiredDesc'),
        ];
    }
}
