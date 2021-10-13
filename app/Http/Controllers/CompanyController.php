<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use App\Http\Requests\UpdateCompanyProfileRequest;
use App\Models\Company;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $companies = Company::all();
        return view('admin.company.index', compact('companies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user = auth()->user();
        $company = Company::where('user_id', $user->id)->first();
        
        $webRoute = $company ? "company.profile.update" : "company.profile.store";
        return view('company.create', compact('company', 'webRoute', 'user'));
    }

    public function pending()
    {
        $companies = Company::where('status', 'pending')->get();
        return view('admin.company.pending', compact('companies'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreCompanyProfileRequest $request)
    {
        ["company_name"=>$companyName, "company_email"=>$companyEmail, 
            "company_phone"=>$companyPhone, "rc_no"=>$rcNo]= $request->validated();
        $companyData = [
            "company_name"=>$companyName,
            "company_email"=>$companyEmail,
            "company_phone"=>$companyPhone,
            "rc_no"=>$rcNo,
            "user_id"=>auth()->id(),
            "status"=> 'pending'
        ];
        if($request->cac){
            $path = $request->cac->store('cac', 'public');
            $companyData['cac'] = $path;
        }
        if($request->logo){
            $path = $request->logo->store('companyLogo', 'public');
            $companyData['logo'] = $path;
        }
        
        Company::create($companyData);
        return back()->with('success', 'Company Profile Updated Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function show(Company $company)
    {
        return view('admin.company.show', compact('company'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function accept(Company $company)
    {
        $this->authorize('admin');
        $company->update(['status'=>'verified']);
        return redirect()->route('admin.company.pending');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateCompanyProfileRequest $request, Company $company)
    {
        ["company_name"=>$companyName, "company_email"=>$companyEmail, 
            "company_phone"=>$companyPhone, "rc_no"=>$rcNo]= $request->validated();
        $companyData = [
            "company_name"=>$companyName,
            "company_email"=>$companyEmail,
            "company_phone"=>$companyPhone,
            "rc_no"=>$rcNo,
        ];
        if($request->cac){
            $path = $request->cac->store('cac', 'public');
            $companyData['cac'] = $path;
        }
        if($request->logo){
            $path = $request->logo->store('companyLogo', 'public');
            $companyData['logo'] = $path;
        }
        $company->update($companyData);
        return back()->with('success', 'Company updated successfully');
    }

    public function wallet(Request $request)
    {
        $user = auth()->user();
        $company = $user->company;
        $transactions = $user->transactions->reverse();
        return view("company.wallet.create", compact('company', 'transactions', 'user'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function destroy(Company $Company)
    {
        //
    }
}
