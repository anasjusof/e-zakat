<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class BankRequest extends Request
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
        if($this->method() == 'POST')
        {
            return [
                'name'=>'required',
                'account_number'=>'required|unique:banks',
            ];
        }
    }

    public function messages()
    {
        return [
            'name.required' => 'The bank name is required.',
        ];
    }
}
