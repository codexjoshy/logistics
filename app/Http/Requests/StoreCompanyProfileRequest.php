<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCompanyProfileRequest extends FormRequest
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
            "company_name"=> 'required|string|unique:companies,company_name',
            "company_email"=> 'required|email|unique:companies,company_email',
            "company_phone" => 'required|numeric|unique:companies,company_phone',
            "rc_no"=> 'required|string|unique:companies,rc_no',
            "cac" => 'nullable|file|mimes:png,jpg,pdf,jpeg|max:500',
            "logo" => 'nullable|file|mimes:png,jpg,jpeg|max:500',
            "username"=> 'required|string|unique:companies,username',
            "address"=> 'required|string',
            "state"=> 'required|string',
            "lga"=> 'required|string',
        ];
    }
}
