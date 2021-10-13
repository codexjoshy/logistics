<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateCompanyProfileRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->type == 'company'&& auth()->user()->company->id == $this->company->id;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            "company_name"=> 'required|string|unique:companies,company_name,'.$this->company->id,
            "company_email"=> 'required|string|unique:companies,company_email,'. $this->company->id,
            "company_phone" => 'required|numeric|unique:companies,company_phone,'. $this->company->id,
            "rc_no"=> 'required|string|unique:companies,rc_no,'. $this->company->id,
            "cac" => 'nullable|file|mimes:png,jpg,pdf,jpeg|size:100'
        ];
    }
}
