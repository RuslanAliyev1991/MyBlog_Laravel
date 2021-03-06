<?php

namespace App\Http\Requests;

use App\Rules\ContactRule;
use Illuminate\Foundation\Http\FormRequest;

class ContactRequest extends FormRequest
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
        return
            [
                'name' => ['required', 'min:3', 'max:20'],
                'email' => ['required', 'email'],
                'phone' => ['required', 'min:10', 'max:10', new ContactRule],
                'message' => ['required']
            ];
    }
}