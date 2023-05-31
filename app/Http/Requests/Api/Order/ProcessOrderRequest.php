<?php

namespace App\Http\Requests\Api\Order;

use Illuminate\Foundation\Http\FormRequest;

class ProcessOrderRequest extends FormRequest
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
            'email' => 'bail|required|email',
            'first_name' => 'bail|required|string|max:50',
            'last_name' => 'bail|required|string|max:50',
            'phone' => 'bail|required|string|max:20',
            'address' => 'bail|required|string|max:250',
            'city' => 'bail|required|string',
            'state' => 'bail|required|string',
            'postal_code' => 'bail|required|string|max:10',
            'country' => 'bail|required|string',
            'shipping_address' => 'bail|required|string|max:250',
            'shipping_email' => 'bail|required|email',
            'shipping_note' => 'bail|nullable|string|max:250',
        ];
    }
}
