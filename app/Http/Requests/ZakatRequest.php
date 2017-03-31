<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class ZakatRequest extends Request
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
                'receipts_image'=>'required|mimes:jpg,jpeg,png,pdf',
            ];
        }
    }

    public function messages()
    {
        return [
            'receipts_image.required' => 'Please upload the receipt.',
            'receipts_image.mimes' => 'The receipt must be jpg, jpeg, png or pdf type.',
        ];
    }
}
