<?php

namespace App\Http\Controllers;

use App\Models\Company;
use App\Models\Order;
use App\Services\CompanyRouteService;
use App\Services\OrderService;
use App\Services\PlaceRequestService;
use Carbon\Carbon;
use Illuminate\Http\Request;

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
                $company = $user->rider->company_id;
                $dailyRoutes = $this->companyRouteService->dailyRoute($company, $user->rider->id);
                $orders = Order::whereDate('created_at', Carbon::today())
                ->where('id', $user->rider->id)->get();
                return view('dashboard', compact('user','type', 'dailyRoutes', 'services', 'orders'));
                break;
            case 'company':
                $company = $user->company;
                $url = $company ? url('/')."/request/company/?name={$company->company_name}":'';
                $companyRequest = $company ? $this->requestService->companyPendingRequest($company->id) :0;
                $pendingOrders = $company ? $this->orderService->companyOrders($company->id, 'pending') : 0;
                $pendingOrders = $pendingOrders ? count($pendingOrders) : 0;
                $assignedOrders = $company ? $this->orderService->companyOrders($company->id, 'accepted') : [];
                $assignedOrders = count($assignedOrders)?:0;
                $completedOrders = $company ? $this->orderService->companyOrders($company->id, 'delievered') : [];
                $completedOrders = count($completedOrders)?:0;
                $orderInTransit = $company ? $this->orderService->companyOrders($company->id, 'in-transit') : [];
                $completedOrders = count($orderInTransit)?:0;
                return view('dashboard', compact('company', 'url', 'pending', 'companyRequest', 'assignedOrders', 'completedOrders', 'orderInTransit'));
                break;
            case 'admin':
                // $url = url('/')."/request/company/?name={$company->company_name}";
                $registerdCompanies = Company::select('id')->get();
                $registerdCompanies = count($registerdCompanies) ?: 0;
                return view('dashboard', compact('registerdCompanies', 'pending'));
                break;
            default:
                # code...
                break;
        }
        
    }
}
