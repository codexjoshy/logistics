<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Route;
use App\Models\RouteDirection;
use App\Services\CompanyRouteService;
use Carbon\Carbon;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    protected CompanyRouteService $companyRouteService;
    public function __construct(CompanyRouteService $companyRouteService){
        $this->companyRouteService = $companyRouteService;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $company = auth()->user()->company;
        $dailyRoutes = $company ? $this->companyRouteService->dailyRoute($company->id) : [];
        $riders = $company->riders ?? [];
        $services = $this->companyRouteService;
        return view("company.routes.create", compact('company', 'dailyRoutes', 'services', 'riders'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, Company $company)
    {
        if ($company->user->isOwing()) {
            return back()->with('error', 'You dont have sufficient balance in your wallet');
        }
        $request->validate([
            'departure'=> 'required|string',
            'status'=> 'required|in:available,transit,completed',
            'routeName'=> 'required|array',
            'routeName.*'=> 'required|string',
            'rider'=> 'required|integer|exists:riders,id'
        ]);
        ["departure"=> $departure, "status"=>$status, "routeName"=> $direction, "rider"=>$rider] = $request->all();
        
        // dd($d);
        $route = Route::create([
            "company_id"=> $company->id,"rider_id"=> $rider,
            "departure"=> $departure, "status"=>$status,
        ]);
        array_map(fn($name)=>RouteDirection::create([
            "company_id"=>$company->id, 
            "route_id"=> $route->id,
            "name" => $name
        ]), $direction);
        return back()->with('success', 'Routes Created Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function pendingRequest(Route $route)
    {
        $routeRequests = $this->companyRouteService->routeRequest($route->id);
        // dd($routeRequests[0]->route->directions);
        return view('company.routes.request', compact('routeRequests'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Company $company, Route $route)
    {
        $dailyRoutes = $route->directions->pluck('name');
        return view('company.routes.edit', compact('company', 'dailyRoutes', 'route'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Company $company, Route $route)
    { 
        $request->validate([
            'routeName'=> 'required|array',
            'routeName.*'=> 'required|string',
        ]);
        $route->directions()->delete();
        array_map(fn($name)=>RouteDirection::create([
            "company_id"=>$company->id, 
            "route_id"=> $route->id,
            "name" => $name
        ]), $request->routeName);
        return back()->with('success', 'Route Updated Successfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        //
    }
}
