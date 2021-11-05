<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateRiderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->type == 'company';
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "rider_first_name"=> 'required|string',
            "rider_last_name"=> 'required|string',
            "rider_email"=> 'required|email|unique:users,email',
            "rider_phone"=> 'required|numeric|unique:users,phone',
            "rider_uid"=> 'required|string|unique:riders,rider_uid',
            "rider_address"=> 'required|string',
            "passport"=> 'nullable|file|mimes:png,jpg,jpeg|max:900'
        ];
    }
}
