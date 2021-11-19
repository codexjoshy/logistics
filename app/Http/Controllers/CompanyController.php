<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCompanyProfileRequest;
use App\Http\Requests\UpdateCompanyProfileRequest;
use App\Models\Company;
use App\Services\TransactionService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Gate;

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
        $verified = $company ? $company->isVerified() : false;
        return view('company.create', compact('company', 'webRoute', 'user', 'verified'));
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
        try {
            ["company_name"=>$companyName, "company_email"=>$companyEmail, 
            "company_phone"=>$companyPhone, "rc_no"=>$rcNo, "username"=>$username, "address"=>$address,
            "state"=>$state,
            "lga"=>$lga]= $request->validated();
            $companyData = [
                "company_name"=>$companyName,
                "company_email"=>$companyEmail,
                "company_phone"=>$companyPhone,
                "rc_no"=>$rcNo,
                "user_id"=>auth()->id(),
                "status"=> 'pending',
                "username"=> $username,
                "address"=>$address,
                "state"=>$state,
                "lga"=>$lga
            ];
            if($request->cac){
                $path = $request->cac->store('cac', 'public');
                $companyData['cac'] = $path;
            }
            if($request->logo){
                $path = $request->logo->store('companyLogo', 'public');
                $companyData['logo'] = $path;
            }
            DB::beginTransaction();
            Company::create($companyData);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', "Sorry there seem to be a problem with your application, contact support with:".$th->getMessage());
        }
        
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
        try {
            DB::beginTransaction();
            (new TransactionService)->credit($company->user->id, 500, 'Registration Bonus From Book Logistic', 1);
            $company->update(['status'=>'verified']);
            DB::commit();
        } catch (\Throwable $th) {
            DB::rollback();
            return back()->with('error', 'Sorry unable to approve company. kindly contact support with: '. $th->getMessage());
        }
        
        return redirect()->route('admin.company.pending')->with('success', 'Company Approved Successfully, with a bonus credit of 500');
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Company  $Company
     * @return \Illuminate\Http\Response
     */
    public function reject(Request $request, Company $company)
    {
        $this->authorize('admin');
        $company->update(['status'=>'review', 'reason'=> $request->reason]);
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
        [ "company_email"=>$companyEmail, 
            "company_phone"=>$companyPhone, "username"=>$username, "address"=>$address,
            "state"=>$state,
            "lga"=>$lga,]= $request->validated();
        $companyData = [
            "company_email"=>$companyEmail,
            "company_phone"=>$companyPhone,
            "username"=>$username,
            "address"=>$address,
            "state"=>$state,
            "lga"=>$lga,
        ];
        if (Gate::allows('admin') && $company->status == 'verified') {
            $companyData["company_name"] = $request->company_name;
            $companyData["rc_no"]=$request->rc_no;
            if($request->cac && $company->status != 'verified'){
                $path = $request->cac->store('cac', 'public');
                $companyData['cac'] = $path;
            }
        }
        if ( $company->status != 'verified') {
            if($request->cac ){
                $path = $request->cac->store('cac', 'public');
                $companyData['cac'] = $path;
            }
            $companyData["rc_no"]=$request->rc_no;
        }
        if($request->logo){ 
            $path = $request->logo->store('companyLogo', 'public');
            $companyData['logo'] = $path;
        }
        if ($request->slogan) {
            $companyData['slogan'] = $request->slogan;
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
