<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateRiderRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return auth()->user()->type == 'company'&& $this->company->id == $this->rider->company_id;
        ;
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
            "rider_email"=> 'required|email|unique:users,email, '. $this->rider->user->id,
            "rider_phone"=> 'required|numeric',
            "rider_uid"=> 'required|string|unique:riders,rider_uid, '. $this->rider->id,
            "rider_address"=> 'required|string',
            "status"=> 'required|string|in:active,inactive,suspended',
            "passport"=> 'nullable|file|mimes:png,jpg,jpeg|max:900'
        ];
    }
}
