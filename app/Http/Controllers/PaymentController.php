<?php

namespace App\Http\Controllers;

use App\Models\Payment;
use Illuminate\Http\Request;
use App\Interfaces\PaymentInterface;
use App\Notifications\WalletCreditedNotification;
use App\Services\PaymentService;
use App\Services\PaystackPaymentService;
use App\Services\TransactionService;

class PaymentController extends Controller
{
    protected TransactionService $transactionService;
    public function __construct(TransactionService $transactionService) {
        $this->transactionService = $transactionService;
    }
    /**
     * Verify a resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function verify(Request $request, PaystackPaymentService $gateway)
    {
        $reference = $request->ref;

        $payment = Payment::where('reference', $reference)->first();
        if (!$payment) {
            return redirect()->route('dashboard')->with('error', 'Payment record not found');
        }
        if ($payment->status == 'success') {
            // return redirect()->route('dashboard')->with('error', 'Payment already resolved.');
        }
        ['status' => $status, 'error' => $error] = $gateway->verify($reference);
        if (!$status) {
            // $gateway->status = 'fail';
            // $gateway->response = ['status' => $status, 'error' => $error];
            // $gateway->save();
            return redirect()->route('dashboard')->with('error', $error['message']);
        }
        $data = $status['data'];
        $amount = $payment->amount;

    //    dd( $amount * 100 == $data['amount'], strtolower($data['status'])=='success', $payment);

        $payment->update(['status' => 'success']);
        if ($amount * 100 == $data['amount'] && strtolower($data['status']) == 'success') {
            $user = $payment->user;
            $amount = $payment->amount;
            // if($payment->item == 'wallet_crediting'){
                $this->transactionService->credit($user->id, $amount, 'Wallet Crediting');
                $user->notify(new WalletCreditedNotification($amount));
                return redirect()->route('company.wallet')->with('success', 'Payment Successful');
            // }
        }
        return redirect()->route('dashboard')->with('error', 'Unable to carryout payment');
    }

    /** */
    public function issues()
    {
        $payments = Payment::where(['status' => 'fail', 'user_id' => auth()->id()])->get();
        return view('user.wallet.issues', compact('payments'));
    }
}