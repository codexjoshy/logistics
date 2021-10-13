<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    public function create(Request $request)
    {
        return view('profile.create');
    }
    
}
