<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use App\Models\Company;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Services\OrderService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Services\CompanyRouteService;
use App\Services\PlaceRequestService;

class DashboardController extends Controller
{
    protected CompanyRouteService $companyRouteService;
    protected PlaceRequestService $requestService;
    protected OrderService $orderService;
    public function __construct(CompanyRouteService $companyRouteService, PlaceRequestService $requestService, OrderService $orderService) {
        $this->companyRouteService = $companyRouteService;
        $this->requestService = $requestService;
        $this->orderService = $orderService;
    }
    public function home(Request $request)
    {
        $user = auth()->user();
        $type = $user->type;
        $dailyRoutes =  $orders = [];
        $services = $this->companyRouteService;
        $pending = $this->requestService->numberOfPoolRequest();
        switch ($type) {
            case 'rider':
                $rider = $user->rider;
                $company = $rider->company;
                $dailyRoutes = $this->companyRouteService->dailyRoute($company->id, $rider->id);
                $orders = Order::whereDate('created_at', Carbon::today())
                ->where('rider_id', $rider->id)->get();
                return view('dashboard', compact('user','type', 'dailyRoutes', 'services', 'orders', 'company', 'rider'));
                break;
            case 'company':
                $company = $user->company;
               
                $name = str_replace("26","&",$company->username);
                // $name = urldecode($name);
                $url = $company ? url('/')."/operator/{$name}":'';
                $companyRequest = $company ? $this->requestService->companyPendingRequest($company->id) :0;
                $pendingOrders = $company ? $this->orderService->companyOrders($company->id, 'pending') : 0;
                $pendingOrders = $pendingOrders ? count($pendingOrders) : 0;
                $assignedOrders = $company ? $this->orderService->companyOrders($company->id, 'accepted') : [];
                $assignedOrders = count($assignedOrders)?:0;
                $completedOrders = $company ? $this->orderService->companyOrders($company->id, 'delievered') : [];
                $completedOrders = count($completedOrders)?:0;
                $orderInTransit = $company ? $this->orderService->companyOrders($company->id, 'in-transit') : [];
                $orderInTransit = count($orderInTransit)?:0;
                $groupUrl = "https://chat.whatsapp.com/LRp0BKTwayl59OlLuZ4Pul";
                return view('dashboard', compact('company', 'url', 'pending', 'companyRequest', 'assignedOrders', 'completedOrders', 'orderInTransit', 'groupUrl'));
                break;
            case 'admin':
                // $url = url('/')."/request/company/?name={$company->company_name}";
                $registerdCompanies = Company::select('id')->get();
                $registerdCompanies = count($registerdCompanies) ?: 0;
                return view('dashboard', compact('registerdCompanies', 'pending'));
                break;
            default:
            return view('dashboard');
                break;
        }
        
    }
    public function changePassword(Request $request)
    {
        return view('change-password');
    }

    public function updatePassword(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "old"=>[
                "required",
                function ($attribute, $value, $fail)
                {
                    $password = auth()->user()->password;
                   if(!Hash::check($value, $password)){
                       $fail('Please Enter your current password');
                   }
                }
            ],
            "password"=> ['required', 'string','confirmed'],
            "password_confirmation"=> 'required|string'
        ]);
        $password = bcrypt($request->password);
        User::find(Auth::id())->update(["password"=> $password]);
        return back()->with('success', 'Password updated successfully');
    }
}
