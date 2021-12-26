<?php

use App\Http\Controllers\AjaxController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\FrontendController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PlaceRequestController;
use App\Http\Controllers\PriceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RequestController;
use App\Http\Controllers\RiderController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\TransactionController;
use Illuminate\Foundation\Auth\EmailVerificationRequest;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


require __DIR__.'/auth.php';

Route::get('payment/verify', [PaymentController::class, 'verify'])->name('payment.verify');

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'home'] )->name('dashboard');
    Route::get('change-password', [DashboardController::class, 'changePassword'])->name('change.password');
    Route::post('update-password', [DashboardController::class, 'updatePassword'])->name('update.password');
    Route::middleware('can:company')->group(function () {
        Route::get('company/profile', [CompanyController::class, 'create'])->name('company.profile.create');
        Route::post('company/profile/store', [CompanyController::class, 'store'])->name('company.profile.store');
        Route::post('company/profile/update/{company}', [CompanyController::class, 'update'])->name('company.profile.update');
        Route::get('company/riders/create/', [RiderController::class, 'create'])->name('company.riders.create');
        Route::post('company/riders/store/{company}', [RiderController::class, 'store'])->name('company.riders.store');
        Route::post('company/{company}/riders/update/{rider}', [RiderController::class, 'update'])->name('company.riders.update');
        Route::get('company/{company}/riders/edit/{rider}', [RiderController::class, 'edit'])->name('company.riders.edit');

        Route::get('company/route/create/', [RouteController::class, 'create'])->name('company.route.create');
        Route::get('company/{company}/route/{route}/edit/', [RouteController::class, 'edit'])->name('company.route.edit');
        Route::post('company/route/store/{company}', [RouteController::class, 'store'])->name('company.route.store');
        Route::post('company/{company}/route/{route}/edit/', [RouteController::class, 'update'])->name('company.route.update');
        Route::get('company/route/{route}/request', [RouteController::class, 'pendingRequest'])->name('company.route.request');

        Route::get('request/pending/{placeRequest}', [PlaceRequestController::class, 'show'])->name('request.pending');
        Route::post('request/approve/{placeRequest}', [PlaceRequestController::class, 'approve'])->name('request.approve');
        Route::get('company/daily/order', [OrderController::class, 'index'])->name('company.daily.order');
        Route::get('company/previous/order', [OrderController::class, 'previous'])->name('company.previous.order');
        Route::get('company/orders/{order}/show', [OrderController::class, 'show'])->name('company.order.show');
        Route::post('company/orders/{order}/update', [OrderController::class, 'update'])->name('company.order.update');
        Route::get('company/daily/pool', [PlaceRequestController::class, 'index'])->name('company.daily.pool');
        Route::get('company/daily/request', [PlaceRequestController::class, 'dailyRequest'])->name('company.daily.request');

        Route::get('company/wallet', [CompanyController::class, 'wallet'])->name('company.wallet');
        Route::post('wallet/store/{user}', [TransactionController::class, 'store'])->name('wallet.store');
    });
    Route::middleware('can:rider')->group(function(){
        Route::get('rider/order/{order}', [OrderController::class, 'riderOrder'])->name('rider.order');
        Route::post('rider/order/{order}/update', [OrderController::class, 'updateOrderStatus'])->name('rider.order.update');
    });

    Route::middleware('can:admin')->group(function () {
        Route::get('admin/company/pending', [CompanyController::class, 'pending'])->name('admin.company.pending');
        Route::get('admin/company/register', [CompanyController::class, 'index'])->name('admin.company.index');
        Route::get('admin/company/{company}', [CompanyController::class, 'show'])->name('admin.company.show');
        Route::post('admin/company/{company}/accept', [CompanyController::class, 'accept'])->name('admin.company.accept');
        Route::post('admin/company/{company}/reject', [CompanyController::class, 'reject'])->name('admin.company.reject');
        Route::get('admin/price/create', [PriceController::class, 'create'])->name('admin.option.price');
        Route::post('admin/price/store', [PriceController::class, 'store'])->name('admin.option.price.store');
    });

    Route::domain("{username}".config('app.url'))->group(function (){
        
    });

});





Route::get('/', function () {
    $apiKey = config('app.google_api');
    return view('frontend.index',compact('apiKey'));
})->name('frontend.index');
Route::view('success','frontend.success')->name('success');
Route::view('terms-and-condition','frontend.terms')->name('terms.condition');

Route::get('result', [FrontendController::class, 'result'])->name('frontend.result');
Route::get('contact', [FrontendController::class, 'contact'])->name('frontend.contact'); 
Route::post('contact', [FrontendController::class, 'contactProcess'])->name('frontend.contact.process');
Route::get('operator/{name}', [FrontendController::class, 'requestCompany'])->name('frontend.request.company');
Route::post('request/route/{route}', [PlaceRequestController::class, 'store'])->name('make.request');
Route::post('request/', [PlaceRequestController::class, 'sendRequest'])->name('send.request');

Route::post('api/order/check/order', [AjaxController::class, 'checkOrder'])->name('check.order');
Route::post('api/order/check/order/otp', [AjaxController::class, 'checkOrderOtp'])->name('check.order.otp');
Route::post('api/generate/price', [AjaxController::class, 'getPriceByDistance'])->name('generate.price');







