<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateRiderRequest;
use App\Http\Requests\UpdateRiderRequest;
use App\Models\Company;
use App\Models\Rider;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RiderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {

        return view('company.riders.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = auth()->user()->company ;
        $riders = $company ? $company->riders->reverse() : [];
        return view("company.riders.create", compact('company', 'riders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateRiderRequest $request, Company $company)
    {
        $validated = $request->validated();
        $user = User::create([
            "email" => $validated['rider_email'], "name" => $validated['rider_name'],
            "phone" => $validated['rider_phone'], "password" => Hash::make('password'),
            "type" => 'rider'
        ]);
        if ($request->passport) {
            $path = $request->passport->store('riders', 'public');
            $validated['passport'] = $path;
        }
        Rider::create([
            "rider_uid" => $validated['rider_uid'], "status" => "active", "user_id" => $user->id,
            "rider_address" => $validated['rider_address'], "company_id" => $company->id
        ]);
        //TODO SEND MAIL TO RIDER
        return back()->with('success', 'Riders created successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function show(Rider $rider)
    {
        return view('company.riders.show', compact('rider'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Rider $rider)
    {
        return view('company.riders.edit', compact('rider', 'company'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateRiderRequest $request, Company $company, Rider $rider)
    {
        [
            "rider_email" => $email, "rider_phone" => $phone, "status" => $status,
            "rider_address" => $address, "rider_name" => $name, "rider_uid" => $uid,
        ] = $request->validated();
        $path = null;
        if ($request->passport) {
            $path = $request->passport->store('riders', 'public');
        }
        $user = $rider->user;
        $user->update(["email" => $email, "phone" => $phone, "name" => $name]);
        $rider->update([
            "rider_uid" => $uid, "rider_address" => $address,
            "status" => $status, "passport"=> $path
        ]);
        return back()->with('success', 'Riders updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Rider  $rider
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rider $rider)
    {
        //
    }
}
