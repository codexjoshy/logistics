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

        $routes = RouteDirection::with('route')
            ->where('name', 'like', "%$pickup%")
            // ->orWhere('name', 'like', "%$destination%")
            ->whereDate('created_at', Carbon::today())
            ->get()->pluck('route');
        // dd($routes);
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
        Notification::send(new ContactUsNotification($request->email, $request->phone, $request->message));
        return back()->with('success', 'Thank you for contacting us. We will contact you with details provided');
    }
    public function requestCompany(Request $request)
    {
        if(!$request->name) return redirect()->route('frontend.index')->with('error', 'Sorry we could not find the link you requested. Please try again with a different link.');
        $request->validate(['name'=> 'required', 'string','exists:companies,company_name']);
        try {
            $company = Company::where('company_name', $request->name)->first();
            
            throw_if(!$company, new Exception('Could not find the company you requested.'));
        } catch (\Throwable $th) {
           return redirect()->route('frontend.index', $th->getMessage());
        }    
        return view('frontend.company', compact('company'));
    }
}
