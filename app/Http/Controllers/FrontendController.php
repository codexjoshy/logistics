<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Route;
use App\Models\RouteDirection;
use App\Notifications\ContactUsNotification;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;

class FrontendController extends Controller
{
    public function result(Request $request)
    {
        $request->validate([
            "pickup"=> 'required|string',
            "destination"=> 'required|string',
        ]);
        ["pickup"=> $pickup, "destination"=>$destination] = $request->all();

        // $routes = RouteDirection::with('route')
        //     ->where('name', 'like', "%$pickup%")
        //     // ->orWhere('name', 'like', "%$destination%")
        //     ->whereDate('created_at', Carbon::today())
        //     ->get()->pluck('route');
        // dd($routes);
        $pickup = rtrim(ltrim(strip_tags(strtolower($pickup))));
        $destination = rtrim(ltrim(strip_tags(strtolower($destination))));
        $startDay = Carbon::now()->startOfDay();
        $endDay   = $startDay->copy()->endOfDay();
        

        // $routes = DB::select(DB::raw("SELECT * FROM route_directions WHERE INSTR('$pickup $destination',name)<>0 AND created_at between '$startDay' AND '$endDay' "));
        // $routes = RouteDirection::hydrate($routes);
        // $routes = $routes->map(function($route){
        //     $myRoute = Route::where('id', $route->route_id)->first();
        //    return $route->setRelation('route', $myRoute);
        // })->pluck('route');
        //    $routes =  RouteDirection::with('route')->where('name', 'like', "%$pickup%")
        //         ->orWhere('name', 'like', "%$destination%")
        //         ->whereBetween('created_at', [$startDay, $endDay])
        //         ->get()
        //         ->pluck('route');

        $routes = DB::select(DB::raw("SELECT * FROM route_directions WHERE  MATCH(name) AGAINST ('$pickup'  IN NATURAL LANGUAGE MODE WITH QUERY EXPANSION)   AND  created_at between '$startDay' AND '$endDay'" ));
        $routes = RouteDirection::hydrate($routes);
        $routes = $routes->map(function($route){
            $myRoute = Route::where('id', $route->route_id)->first();
            return $route->setRelation('route', $myRoute);
        })->pluck('route');
        return view("frontend.result", compact('routes'));
    }
    public function contact(Request $request)
    {
        return view('frontend.contact');
    }
    public function contactProcess(Request $request)
    {
        $request->validate([
            "email"=>'required|string|email',
            "name"=>'required|string',
            "message"=>'required|string'
        ]);
        try {
            Notification::send(new ContactUsNotification($request->email, $request->phone, $request->message, $request->name));
        } catch (\Throwable $th) {
            return back()->with('error', 'Sorry we were unable to send a message at this time '. $th->getMessage());
        }
       
        return back()->with('success', 'Thank you for contacting us. We will contact you with details provided');
    }
    public function requestCompany(Request $request, string $name)
    {
        if(!$name) return redirect()->route('frontend.index')->with('error', 'Sorry we could not find the link you requested. Please try again with a different link.');
        // $request->validate(['name'=> 'required', 'string','exists:companies,company_name']);
        $companyName = explode('-', $name);
        $companyName = implode(' ', $companyName);

        try {
            $company = Company::where('username', $companyName)->first();
            
            throw_if(!$company, new Exception('Could not find the company you requested.'));
        } catch (\Throwable $th) {
           return redirect()->route('frontend.index', $th->getMessage());
        }    
        return view('frontend.company', compact('company'));
    }
}
